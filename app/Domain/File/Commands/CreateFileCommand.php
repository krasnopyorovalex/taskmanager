<?php

declare(strict_types=1);

namespace Domain\File\Commands;

use App\File;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Task;
use Storage;

/**
 * Class CreateFileCommand
 * @package Domain\File\Commands
 */
class CreateFileCommand
{
    use DispatchesJobs;

    /**
     * @var Task
     */
    private $task;
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $clientOriginalName;

    /**]
     * CreateFileCommand constructor.
     * @param string $path
     * @param string $clientOriginalName
     * @param Task $task
     */
    public function __construct(string $path, string $clientOriginalName, Task $task)
    {
        $this->task = $task;
        $this->path = $path;
        $this->clientOriginalName = $clientOriginalName;
    }

    public function handle(): void
    {
        $file = new File();
        $file->task_id = $this->task->id;
        $file->name = $this->clientOriginalName;
        $file->path = Storage::url($this->path);

        $file->save();
    }
}
