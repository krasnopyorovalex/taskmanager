<?php

declare(strict_types=1);

namespace Domain\Group\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateGroupRequest
 * @package Domain\Group\Requests
 */
class UpdateGroupRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string'
        ];
    }
}
