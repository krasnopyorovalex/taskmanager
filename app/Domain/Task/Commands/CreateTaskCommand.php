<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Http\Requests\Request;
use App\Task;
use Domain\File\Commands\UploadFileCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateTaskCommand
 * @package Domain\Task\Commands
 */
class CreateTaskCommand
{
    use DispatchesJobs;

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
     * @return Task
     */
    public function handle(): Task
    {
        $task = new Task();
        $task->fill($this->request->except('files'));

        $task->save();

        if ($this->request->has('files')) {
            $this->dispatch(new UploadFileCommand($this->request->file('files'), $task));
        }

        return $task;
    }
}
