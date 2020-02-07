<?php

declare(strict_types=1);

namespace App\Domain\Comment\DataMaps;

use App\Comment;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DataMapForComment
 * @package App\Domain\Comment\DataMaps
 */
class DataMapForComment
{
    /**
     * @param Collection $comments
     * @return array
     */
    public function toArray(Collection $comments): array
    {
        $instance = $this;

        return $comments->map(static function (Comment $comment) use ($instance) {
            return $instance->transform($comment);
        })->toArray();
    }

    /**
     * @param Comment $comment
     * @return array
     */
    public function transform(Comment $comment): array
    {
        return [
            'id' => $comment->id,
            'body' => $comment->body,
            'author' => $comment->author->name,
            'created_at' => $comment->created_at->shortRelativeDiffForHumans(),
            'comments' => $comment->comments ? $this->toArray($comment->comments) : []
        ];
    }
}
