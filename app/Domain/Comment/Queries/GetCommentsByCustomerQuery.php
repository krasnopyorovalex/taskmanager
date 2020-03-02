<?php

declare(strict_types=1);

namespace Domain\Comment\Queries;

use App\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GetCommentsByCustomerQuery
 * @package Domain\Comment\Queries
 */
class GetCommentsByCustomerQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetCommentsByCustomerQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Comment[]|Builder[]|Collection
     */
    public function handle()
    {
        return Comment::whereHasMorph(
            'commentable',
            'App\\Customer',
            function (Builder $query) {
                return $query->where('id', $this->id);
            })->latest()->get();
    }
}
