<?php

declare(strict_types=1);

namespace Domain\Customer\Commands;

use App\Customer;
use Exception;

/**
 * Class DeleteCustomerCommand
 * @package Domain\Customer\Commands
 */
class DeleteCustomerCommand
{
    /**
     * @var Customer
     */
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return bool|null
     * @throws Exception
     */
    public function handle(): ?bool
    {
        $this->customer->comments()->delete();

        return $this->customer->delete();
    }
}
