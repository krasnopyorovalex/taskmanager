<?php

declare(strict_types=1);

namespace Domain\Customer\Queries;

use App\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class GetCustomersQuery
 * @package Domain\Customer\Queries
 */
class GetCustomersQuery
{
    /**
     * @return LengthAwarePaginator
     */
    public function handle(): LengthAwarePaginator
    {
        return Customer::with('manager')
            ->latest()
            ->paginate();
    }
}
