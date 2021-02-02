<?php

declare(strict_types=1);

namespace App\Domain\User\Queries;

use App\User;

/**
 * Class GetUsersToInfoOnCreatedTask
 * @package App\Domain\User\Queries
 */
class GetUsersToInfoOnCreatedTask
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return User::where('is_admin', '1')->where('telegram_id', '!=', '0')->get();
    }
}
