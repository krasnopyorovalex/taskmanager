<?php

declare(strict_types=1);

namespace Domain\User\Commands;

use Domain\User\Queries\GetUserByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteUserCommand
 * @package Domain\User\Commands
 */
class DeleteUserCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteUserCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $user = $this->dispatch(new GetUserByIdQuery($this->id));

        return $user->delete();
    }

}
