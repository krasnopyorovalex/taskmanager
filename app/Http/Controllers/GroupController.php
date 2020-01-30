<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Group\Commands\CreateGroupCommand;
use Domain\Group\Commands\DeleteGroupCommand;
use Domain\Group\Commands\UpdateGroupCommand;
use Domain\Group\Queries\GetAllGroupsQuery;
use Domain\Group\Queries\GetGroupByIdQuery;
use Domain\Group\Requests\UpdateGroupRequest;
use Domain\User\Requests\CreateUserRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class GroupController
 * @package App\Http\Controllers
 */
class GroupController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $groups = $this->dispatch(new GetAllGroupsQuery);

        return view('groups.index', compact('groups'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * @param CreateUserRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $this->dispatch(new CreateGroupCommand($request));

        return redirect(route('groups.index'))
            ->with('message', 'Новая группа успешно добавлена');
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function edit(int $id)
    {
        $group = $this->dispatch(new GetGroupByIdQuery($id));

        return view('groups.edit', compact('group'));
    }

    /**
     * @param UpdateGroupRequest $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateGroupRequest $request, int $id)
    {
        $this->dispatch(new UpdateGroupCommand($id, $request));

        return redirect(route('groups.index'))
            ->with('message', 'Информация о группе обновлена');
    }

    /**
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteGroupCommand($id));

        return redirect(route('groups.index'))
            ->with('message', 'Группа успешно удалена');
    }
}
