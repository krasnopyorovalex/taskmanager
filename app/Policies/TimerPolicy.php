<?php

declare(strict_types=1);

namespace App\Policies;

use App\Timer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

/**
 * Class TimerPolicy
 * @package App\Policies
 */
class TimerPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Timer $timer
     * @return Response
     */
    public function update(User $user, Timer $timer): Response
    {
        return $timer->task->performer->id === $user->id
            ? Response::allow()
            : Response::deny(view('layouts.partials.notify', ['message' => __('auth.timer.update.deny')]));
    }
}
