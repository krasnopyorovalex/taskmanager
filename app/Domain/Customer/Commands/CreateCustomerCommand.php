<?php

declare(strict_types=1);

namespace Domain\Customer\Commands;

use App\Customer;
use Domain\Customer\Requests\CreateCustomerRequest;

/**
 * Class CreateCustomerCommand
 * @package Domain\Customer\Commands
 */
class CreateCustomerCommand
{
    /**
     * @var CreateCustomerRequest
     */
    private $request;

    /**
     * CreateCustomerCommand constructor.
     * @param CreateCustomerRequest $request
     */
    public function __construct(CreateCustomerRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $customer = new Customer();
        $customer->fill($this->request->all());

        return $customer->save();
    }
}
