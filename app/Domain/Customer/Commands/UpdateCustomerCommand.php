<?php

declare(strict_types=1);

namespace Domain\Customer\Commands;

use App\Customer;
use Domain\Customer\Requests\UpdateCustomerRequest;

/**
 * Class UpdateCustomerCommand
 * @package Domain\Customer\Commands
 */
class UpdateCustomerCommand
{
    /**
     * @var Customer
     */
    private $customer;
    /**
     * @var UpdateCustomerRequest
     */
    private $request;

    /**
     * UpdateCustomerCommand constructor.
     * @param UpdateCustomerRequest $request
     * @param Customer $customer
     */
    public function __construct(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->customer = $customer;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return $this->customer->update($this->request->all());
    }
}
