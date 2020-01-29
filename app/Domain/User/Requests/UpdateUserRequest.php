<?php

declare(strict_types=1);

namespace Domain\User\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest
 * @package Domain\User\Requests
 */
class UpdateUserRequest extends Request
{
    public function rules(): array
    {
        $user = (int) $this->user;
        return [
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'password' => ['string', 'min:8', 'confirmed', 'nullable'],
            'is_admin' => 'boolean'
        ];
    }
}
