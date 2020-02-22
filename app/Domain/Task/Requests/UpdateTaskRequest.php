<?php

declare(strict_types=1);

namespace Domain\Task\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateTaskRequest
 * @package Domain\Task\Requests
 */
class UpdateTaskRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'deadline' => 'date_format:Y-m-d'
        ];
    }
}
