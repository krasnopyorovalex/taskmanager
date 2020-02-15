<?php

declare(strict_types=1);

namespace Domain\Comment\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateCommentRequest
 * @package Domain\Comment\Requests
 */
class CreateCommentRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'body' => 'required|string',
            'author_id' => 'required|integer|exists:users,id,deleted_at,NULL',
            'parent_id' => 'integer|exists:comments,id|nullable'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'author_id' => auth()->user()->id
        ]);
    }
}
