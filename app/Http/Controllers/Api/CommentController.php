<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Domain\Comment\DataMaps\DataMapForComment;
use App\Http\Controllers\Controller;
use Domain\Comment\Queries\GetCommentsByTaskUuid;
use Illuminate\Http\JsonResponse;

/**
 * Class CommentController
 * @package App\Http\Controllers\Api
 */
class CommentController extends Controller
{
    /**
     * @param string $uuid
     * @return JsonResponse
     */
    public function load(string $uuid): JsonResponse
    {
        $comments = $this->dispatch(new GetCommentsByTaskUuid($uuid));

        $commentsDataMap = new DataMapForComment();

        return response()->json($commentsDataMap->toArray($comments));
    }
}
