<?php

declare(strict_types=1);

namespace App\Rules;

use Domain\Task\Queries\ExistTaskByUuidQuery;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class TaskExist
 * @package App\Rules
 */
class TaskExist implements Rule
{
    use DispatchesJobs;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->dispatch(new ExistTaskByUuidQuery($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Такой задачи не существует.';
    }
}
