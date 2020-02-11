<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Events\NewStoryHasAppeared;
use App\Http\Controllers\Controller;
use App\Task;
use Domain\Comment\DataMaps\DataMap;
use Domain\Comment\Queries\GetCommentsByTaskUuid;
use Domain\Comment\Requests\CreateCommentRequest;
use Domain\Task\Commands\CreateTaskCommentCommand;
use Domain\Task\Queries\GetTaskByUuidQuery;
use Illuminate\Http\JsonResponse;

/**
 * Class CommentController
 * @package App\Http\Controllers\Api
 */
class CommentController extends Controller
{
    /**
     * @var DataMap
     */
    private $commentsDataMap;

    /**
     * CommentController constructor.
     * @param DataMap $commentsDataMap
     */
    public function __construct(DataMap $commentsDataMap)
    {
        $this->commentsDataMap = $commentsDataMap;
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     */
    public function load(string $uuid): JsonResponse
    {
        $comments = $this->dispatch(new GetCommentsByTaskUuid($uuid));

        return response()->json($this->commentsDataMap->toArray($comments));
    }

    /**
     * @param CreateCommentRequest $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function store(CreateCommentRequest $request, string $uuid): JsonResponse
    {
        /** @var Task $task */
        $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

        /** @var Comment $comment */
        $comment = $this->dispatch(new CreateTaskCommentCommand($request, $task));

        event(new NewStoryHasAppeared("Добавлен новый комментарий к задаче #{$comment->commentable->name}"));

        return response()->json($this->commentsDataMap->itemToArray($comment));
    }
}
