<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Group\Queries\GetAllGroupsQuery;
use Domain\User\Commands\CreateUserCommand;
use Domain\User\Commands\DeleteUserCommand;
use Domain\User\Commands\UpdateUserCommand;
use Domain\User\Queries\GetAllUsersQuery;
use Domain\User\Queries\GetUserByIdQuery;
use Domain\User\Requests\CreateUserRequest;
use Domain\User\Requests\UpdateUserRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $users = $this->dispatch(new GetAllUsersQuery);

        return view('users.index', compact('users'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $groups = $this->dispatch(new GetAllGroupsQuery);

        return view('users.create', compact('groups'));
    }

    /**
     * @param CreateUserRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $this->dispatch(new CreateUserCommand($request));

        return redirect(route('users.index'))
            ->with('message', 'Новый пользователь успешно добавлен в систему');
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function edit(int $id)
    {
        $user = $this->dispatch(new GetUserByIdQuery($id));
        $groups = $this->dispatch(new GetAllGroupsQuery);

        return view('users.edit', compact('user', 'groups'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $this->dispatch(new UpdateUserCommand($id, $request));

        return redirect(route('users.index'))
            ->with('message', 'Информация о пользователе обновлена');
    }

    /**
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteUserCommand($id));

        return redirect(route('users.index'))
            ->with('message', 'Пользователь успешно удален');
    }
}
