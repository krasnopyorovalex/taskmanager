<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Customer;
use App\Events\NewStoryHasAppeared;
use App\Http\Controllers\Controller;
use Domain\Comment\DataMaps\DataMap;
use Domain\Comment\Queries\GetCommentsByCustomerQuery;
use Domain\Comment\Requests\CreateCommentRequest;
use Domain\Customer\Commands\CreateCustomerCommentCommand;
use Domain\Customer\Queries\GetCustomerByIdQuery;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * Class CustomerCommentController
 * @package App\Http\Controllers\Api
 */
class CustomerCommentController extends Controller
{
    /**
     * @var DataMap
     */
    private $commentsDataMap;
    /**
     * CustomerCommentController constructor.
     * @param DataMap $commentsDataMap
     */
    public function __construct(DataMap $commentsDataMap)
    {
        $this->commentsDataMap = $commentsDataMap;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $comments = $this->dispatch(new GetCommentsByCustomerQuery($id));

        return response()->json($this->commentsDataMap->toArray($comments));
    }

    /**
     * @param CreateCommentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function store(CreateCommentRequest $request, int $id): JsonResponse
    {
        try {
            /** @var Customer $task */
            $customer = $this->dispatch(new GetCustomerByIdQuery($id));

            /** @var Comment $comment */
            $comment = $this->dispatch(new CreateCustomerCommentCommand($request, $customer));

            event(new NewStoryHasAppeared(__('comment.add', ['entity' => $comment->commentable->name])));
        } catch (Exception $exception) {

            return response()->json([
                'message' => (string) view('layouts.partials.notify', ['message' => $exception->getMessage()])
            ], 400);
        }

        return response()->json($this->commentsDataMap->itemToArray($comment));
    }
}
