<?php

declare(strict_types=1);

namespace Domain\User\Commands;

use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUserCommand
 * @package Domain\User\Commands
 */
class CreateUserCommand
{
    /**
     * @var array
     */
    private $data;

    /**
     * CreateUserCommand constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return User
     */
    public function handle(): User
    {
        return User::create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => Hash::make($this->data['password']),
        ]);
    }

}
