<?php

declare(strict_types=1);

namespace Domain\Comment\Queries;

use App\Comment;
use App\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GetCommentsByTaskUuid
 * @package Domain\Comment\Queries
 */
class GetCommentsByTaskUuid
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * GetCommentsByTaskUuid constructor.
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
        $uuid = $this->uuid;

        return Comment::whereHasMorph(
            'commentable',
            'App\\Task',
            static function (Builder $query) use ($uuid) {
                return $query->where('uuid', $uuid);
        })->latest()->get();
    }
}
