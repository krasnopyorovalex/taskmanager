<?php

declare(strict_types=1);

namespace Domain\Task\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateTaskRequest
 * @package Domain\User\Requests
 */
class CreateTaskRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'body' => 'required|string',
            'deadline' => 'date_format:Y-m-d|nullable',
            'author_id' => 'required|integer|exists:users,id',
            'files' => 'array'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'author_id' => auth()->user()->id
        ]);
    }
}
