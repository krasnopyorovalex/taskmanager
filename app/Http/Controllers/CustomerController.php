<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Customer\Commands\CreateCustomerCommand;
use Domain\Customer\Commands\DeleteCustomerCommand;
use Domain\Customer\Commands\UpdateCustomerCommand;
use Domain\Customer\Queries\GetCustomerByIdQuery;
use Domain\Customer\Queries\GetCustomersQuery;
use Domain\Customer\Requests\CreateCustomerRequest;
use Domain\Customer\Requests\UpdateCustomerRequest;
use Domain\User\Queries\GetUsersWithMyGroupsQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $customers = $this->dispatch(new GetCustomersQuery);

        return view('customers.index', compact('customers'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $groups = auth()->user()->onlyMyGroups();

        $managers = $this->dispatch(new GetUsersWithMyGroupsQuery($groups));

        return view('customers.create', compact('managers'));
    }

    /**
     * @param CreateCustomerRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateCustomerRequest $request)
    {
        $this->dispatch(new CreateCustomerCommand($request));

        return redirect(route('customers.index'))
            ->with('message', 'Новый заказчик успешно добавлен');
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function edit(int $id)
    {
        $customer = $this->dispatch(new GetCustomerByIdQuery($id));

        $groups = auth()->user()->onlyMyGroups();
        $managers = $this->dispatch(new GetUsersWithMyGroupsQuery($groups));

        return view('customers.edit', compact('customer', 'managers'));
    }

    /**
     * @param UpdateCustomerRequest $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateCustomerRequest $request, int $id)
    {
        $customer = $this->dispatch(new GetCustomerByIdQuery($id));

        $this->dispatch(new UpdateCustomerCommand($request, $customer));

        return redirect(route('customers.edit', $customer))
            ->with('message', 'Информация о заказчике обновлена');
    }

    public function destroy(int $id)
    {
        $customer = $this->dispatch(new GetCustomerByIdQuery($id));

        $this->dispatch(new DeleteCustomerCommand($customer));

        return redirect(route('customers.index'))
            ->with('message', 'Заказчик успешно удален');
    }
}
