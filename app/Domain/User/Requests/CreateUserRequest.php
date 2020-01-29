<?php

declare(strict_types=1);

namespace Domain\User\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateUserRequest
 * @package Domain\User\Requests
 */
class CreateUserRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_admin' => 'boolean'
        ];
    }
}
