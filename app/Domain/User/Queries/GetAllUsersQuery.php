<?php

declare(strict_types=1);

namespace Domain\User\Queries;

use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class GetAllUsersQuery
 * @package Domain\User\Queries
 */
class GetAllUsersQuery
{
    /**
     * Execute the job.
     */
    public function handle(): LengthAwarePaginator
    {
        return User::with(['groups'])->paginate();
    }
}
