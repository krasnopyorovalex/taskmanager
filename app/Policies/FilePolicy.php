<?php

declare(strict_types=1);

namespace App\Policies;

use App\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class FilePolicy
 * @package App\Policies
 */
class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the task.
     *
     * @param User $user
     * @param File $file
     * @return boolean
     */
    public function delete(User $user, File $file): bool
    {
        return $user->id === $file->task->author->id;
    }
}
