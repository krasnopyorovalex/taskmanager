<?php

declare(strict_types=1);

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

/**
 * Class TaskPolicy
 * @package App\Policies
 */
class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the task.
     *
     * @param User $user
     * @param Task $task
     * @return boolean
     */
    public function view(User $user, Task $task): bool
    {
        $groups = $task->author->groups()->get();

        foreach ($groups as $group) {
            if ($user->hasGroup($group)) {
                return true;
            }
        }

        return $user->id === $task->author->id;
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param User $user
     * @param Task $task
     * @return Response
     */
    public function update(User $user, Task $task): Response
    {
        return $user->id === $task->author->id
            ? Response::allow()
            : Response::deny(view('layouts.partials.notify', ['message' => __('task.update.denied')]));
    }

    /**
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function complete(User $user, Task $task): bool
    {
        return $user->id === $task->performer->id;
    }

    /**
     * Determine whether the user can close the task.
     *
     * @param User $user
     * @param Task $task
     * @return Response
     */
    public function close(User $user, Task $task): Response
    {
        return ($user->id === $task->author->id || $user->isAdmin())
            ? Response::allow()
            : Response::deny(view('layouts.partials.notify', ['message' => __('task.update.denied')]));
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param User $user
     * @param Task $task
     * @return boolean
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->author->id;
    }
}
