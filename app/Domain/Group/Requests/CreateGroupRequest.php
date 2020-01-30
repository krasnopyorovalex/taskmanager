<?php

declare(strict_types=1);

namespace Domain\Group\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateGroupRequest
 * @package Domain\Group\Requests
 */
class CreateGroupRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string'
        ];
    }
}
