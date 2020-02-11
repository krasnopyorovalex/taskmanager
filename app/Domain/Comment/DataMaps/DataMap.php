<?php

declare(strict_types=1);

namespace Domain\Comment\DataMaps;

use App\Comment;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DataMap
 * @package Domain\Comment\DataMaps
 */
abstract class DataMap
{
    /**
     * @param Collection $comments
     * @return array
     */
    abstract public function toArray(Collection $comments): array;

    /**
     * @param Comment $comment
     * @return array
     */
    abstract public function itemToArray(Comment $comment): array;
}
