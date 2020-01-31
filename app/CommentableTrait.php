<?php

declare(strict_types=1);

namespace App;

/**
 * Trait CommentableTrait
 * @package App
 */
trait CommentableTrait
{
    /**
     * Get all of the task's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
