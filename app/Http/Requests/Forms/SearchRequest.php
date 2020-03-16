<?php

declare(strict_types=1);

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;

/**
 * Class SearchRequest
 * @package App\Http\Requests\Forms
 */
class SearchRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'keyword' => ['required', 'string', 'min:3']
        ];
    }
}
