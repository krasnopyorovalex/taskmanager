<?php

declare(strict_types=1);

namespace Domain\Customer\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateCustomerRequest
 * @package Domain\Customer\Requests
 */
class CreateCustomerRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'services' => 'required|string|max:512',
            'contacts' => 'required|string',
            'description' => 'string|nullable',
            'site' => 'string|max:64|nullable',
            'user_id' => 'required|integer|exists:users,id,deleted_at,NULL'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'contacts' => preg_replace('/(<?)\sstyle=".+?"(>.+?)/i', '$1$2', request('contacts')),
            'description' => preg_replace('/(<?)\sstyle=".+?"(>.+?)/i', '$1$2', request('description'))
        ]);
    }
}
