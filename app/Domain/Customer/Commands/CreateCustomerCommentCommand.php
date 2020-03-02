<?php

declare(strict_types=1);

namespace Domain\Customer\Commands;

use App\Comment;
use App\Customer;
use App\Http\Requests\Request;

/**
 * Class CreateCustomerCommentCommand
 * @package Domain\Customer\Commands
 */
class CreateCustomerCommentCommand
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Customer
     */
    private $customer;
    /**
     * CreateTaskCommentCommand constructor.
     * @param Request $request
     * @param Customer $customer
     */
    public function __construct(Request $request, Customer $customer)
    {
        $this->request = $request;
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $comment = new Comment();

        return $this->customer->comments()->save($comment->fill($this->request->all()));
    }
}
