<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Http\Requests\Request;
use App\Task;

/**
 * Class CreateTaskCommand
 * @package Domain\Task\Commands
 */
class CreateTaskCommand
{
    /**
     * @var Request
     */
    private $request;

    /**
     * CreateUserCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $task = new Task();
        $task->fill($this->request->all());

        if ($this->request->has('files')) {
            dd($this->request->files);
        }

        return $task->save();
    }
}
