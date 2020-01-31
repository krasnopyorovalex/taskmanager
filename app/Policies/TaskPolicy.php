<?php

declare(strict_types=1);

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
