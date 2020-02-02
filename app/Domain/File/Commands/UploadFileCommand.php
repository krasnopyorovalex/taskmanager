<?php

declare(strict_types=1);

namespace Domain\File\Commands;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Task;

/**
 * Class UploadFileCommand
 * @package Domain\File\Commands
 */
class UploadFileCommand
{
    use DispatchesJobs;

    /**
     * @var array
     */
    private $uploadedFiles;
    /**
     * @var Task
     */
    private $task;

    /**
     * UploadFileCommand constructor.
     * @param array $uploadedFiles
     * @param Task $task
     */
    public function __construct(array $uploadedFiles, Task $task)
    {
        $this->uploadedFiles = $uploadedFiles;
        $this->task = $task;
    }

    public function handle(): void
    {
        foreach ($this->uploadedFiles as $uploadedFile) {
            $clientOriginalName = $uploadedFile->getClientOriginalName();

            $path = $uploadedFile->store("public/files/{$this->task->id}");

            $this->dispatch(new CreateFileCommand($path, $clientOriginalName, $this->task));
        }
    }
}
