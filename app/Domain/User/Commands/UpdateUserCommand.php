<?php

declare(strict_types=1);

namespace Domain\User\Commands;

use Domain\User\Queries\GetUserByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateUserCommand
 * @package Domain\User\Commands
 */
class UpdateUserCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    private $except = [
        'password',
        'password_confirmation'
    ];

    /**
     * UpdateUserCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $user = $this->dispatch(new GetUserByIdQuery($this->id));

        if ($this->request->get('password') && $this->validatePassword()->validate()) {
            $user->password = Hash::make($this->request->get('password'));
        }

        return $user->update($this->request->except($this->except));
    }

    /**
     * @return mixed
     */
    private function validatePassword()
    {
        return Validator::make($this->request->only($this->except), [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

}
