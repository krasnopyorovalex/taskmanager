<?php

declare(strict_types=1);

namespace Domain\Comment\Queries;

use App\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GetCommentsByTaskUuidQuery
 * @package Domain\Comment\Queries
 */
class GetCommentsByTaskUuidQuery
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * GetCommentsByTaskUuidQuery constructor.
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return Comment[]|Builder[]|Collection
     */
    public function handle()
    {
        return Comment::whereHasMorph(
            'commentable',
            'App\\Task',
            function (Builder $query) {
                return $query->where('uuid', $this->uuid);
        })->latest()->get();
    }
}
