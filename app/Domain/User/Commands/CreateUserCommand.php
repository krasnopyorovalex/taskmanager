<?php

declare(strict_types=1);

namespace Domain\User\Commands;

use App\Http\Requests\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUserCommand
 * @package Domain\User\Commands
 */
class CreateUserCommand
{
    /**
     * @var Request
     */
    private $request;

    /**
     * CreateUserCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $user = new User();
        $user->fill($this->request->all());

        $user->password = Hash::make($this->request->get('password'));

        $result = $user->save();

        $this->attachGroups($user->fresh());

        return $result;
    }

    /**
     * @param User $user
     */
    protected function attachGroups(User $user): void
    {
        if ($this->request->has('groups')) {
            $user->groups()->attach($this->request->post('groups'));
        }
    }
}
