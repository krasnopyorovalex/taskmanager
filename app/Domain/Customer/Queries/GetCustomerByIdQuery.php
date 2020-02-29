<?php

declare(strict_types=1);

namespace Domain\Customer\Queries;

use App\Customer;

/**
 * Class GetCustomerByIdQuery
 * @package Domain\Customer\Queries
 */
class GetCustomerByIdQuery
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
        return Customer::findOrFail($this->id);
    }
}
