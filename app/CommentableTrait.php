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
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
