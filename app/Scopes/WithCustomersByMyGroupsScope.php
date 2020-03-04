<?php

declare(strict_types=1);

namespace App\Scopes;

use Domain\User\Queries\GetUsersWithMyGroupsQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 *
 * Class WithUsersByMyGroupsScope
 * @package App\Scopes
 */
class WithCustomersByMyGroupsScope implements Scope
{
    use DispatchesJobs;

    private static $customers;

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (! self::$customers) {
            $groups = auth()->user()->onlyMyGroups();
            self::$customers = $this->dispatch(new GetUsersWithMyGroupsQuery($groups));
        }

        $customers = self::$customers;

        $builder->where(static function ($query) use ($customers) {
            return $query->whereIn('user_id', $customers->pluck('id'));
        });
    }
}
