<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Events\NewStoryHasAppeared;
use App\Http\Controllers\Controller;
use App\Task;
use Domain\Comment\DataMaps\DataMap;
use Domain\Comment\Queries\GetCommentsByTaskUuidQuery;
use Domain\Comment\Requests\CreateCommentRequest;
use Domain\Task\Commands\ChangeTaskStatusByNewCommentCommand;
use Domain\Task\Commands\CreateTaskCommentCommand;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Queries\GetTaskByUuidQuery;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * Class TaskCommentController
 * @package App\Http\Controllers\Api
 */
class TaskCommentController extends Controller
{
    /**
     * @var DataMap
     */
    private $commentsDataMap;
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * CommentController constructor.
     * @param DataMap $commentsDataMap
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(DataMap $commentsDataMap, AbstractTaskStatus $taskStatus)
    {
        $this->commentsDataMap = $commentsDataMap;
        $this->taskStatus = $taskStatus;
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     */
    public function show(string $uuid): JsonResponse
    {
        $comments = $this->dispatch(new GetCommentsByTaskUuidQuery($uuid));

        return response()->json($this->commentsDataMap->toArray($comments));
    }

    /**
     * @param CreateCommentRequest $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function store(CreateCommentRequest $request, string $uuid): JsonResponse
    {
        try {
            /** @var Task $task */
            $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

            $this->authorize('view', $task);

            /** @var Comment $comment */
            $comment = $this->dispatch(new CreateTaskCommentCommand($request, $task));

            $this->dispatch(new ChangeTaskStatusByNewCommentCommand($task, $this->taskStatus));

            event(new NewStoryHasAppeared(__('comment.add', ['entity' => $comment->commentable->name])));
        } catch (Exception $exception) {

            return response()->json([
                'message' => (string) view('layouts.partials.notify', ['message' => $exception->getMessage()])
            ], 400);
        }

        return response()->json($this->commentsDataMap->itemToArray($comment));
    }
}
