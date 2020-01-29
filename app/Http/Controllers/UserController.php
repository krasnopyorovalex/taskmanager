<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\User\Commands\UpdateUserCommand;
use Domain\User\Queries\GetAllUsersQuery;
use Domain\User\Queries\GetUserByIdQuery;
use Domain\User\Requests\UpdateUserRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function edit(int $id)
    {
        $user = $this->dispatch(new GetUserByIdQuery($id));

        return view('users.edit', compact('user'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $this->dispatch(new UpdateUserCommand($id, $request));

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
