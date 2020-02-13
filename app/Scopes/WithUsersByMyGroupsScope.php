<?php

declare(strict_types=1);

namespace App\Scopes;

use Domain\User\Queries\GetUsersWithMyGroupsQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class WithUsersByMyGroupsScope
 * @package App\Scopes
 */
class WithUsersByMyGroupsScope implements Scope
{
    use DispatchesJobs;

    private static $authors;

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (! self::$authors) {
            $groups = auth()->user()->onlyMyGroups();
            self::$authors = $this->dispatch(new GetUsersWithMyGroupsQuery($groups));
        }

        $authors = self::$authors;

        $builder->with(['timer', 'author', 'performer'])->where(static function ($query) use ($authors) {
            return $query->whereIn('author_id', $authors->pluck('id'))
                ->orWhere('author_id', auth()->user()->id);
        })->latest();
    }
}
