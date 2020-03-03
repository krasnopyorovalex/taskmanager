<?php

declare(strict_types=1);

namespace App\Scopes;

use Illuminate\Database\Eloquent\Collection;
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

    private static $groups;

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (! self::$groups) {
            /** @var Collection $groups */
            self::$groups = auth()->user()->onlyMyGroups();
        }

        $groups = self::$groups;

        $builder->with(['timer', 'author', 'performer'])->where(static function ($query) use ($groups) {
            return $query->where('author_id', auth()->user()->id)
                ->orWhereIn('group_id', $groups->pluck('id'));
        })->latest();
    }
}
