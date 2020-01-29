<?php

declare(strict_types=1);

namespace Domain\User\Queries;

use App\User;

/**
 * Class GetUserByIdQuery
 * @package Domain\User\Queries
 */
class GetUserByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetUserByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return User::findOrFail($this->id);
    }
}
