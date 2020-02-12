<?php

declare(strict_types=1);

namespace Domain\File\Requests;

use App\Http\Requests\Request;
use App\Rules\TaskExist;

/**
 * Class UploadFilesRequest
 * @package Domain\File\Requests
 */
class UploadFilesRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'files' => 'array|required',
            'uuid' => [new TaskExist]
        ];
    }
}
