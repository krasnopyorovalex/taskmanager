<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Http\Requests\Request;
use App\Services\ThumbCreatorService;
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
     * @var ThumbCreatorService
     */
    private $thumbCreator;

    /**
     * CreateUserCommand constructor.
     * @param Request $request
     * @param ThumbCreatorService $thumbCreator
     */
    public function __construct(Request $request, ThumbCreatorService $thumbCreator)
    {
        $this->request = $request;
        $this->thumbCreator = $thumbCreator;
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
            $this->dispatch(new UploadFileCommand($this->request->file('files'), $task, $this->thumbCreator));
        }

        return $task;
    }
}
