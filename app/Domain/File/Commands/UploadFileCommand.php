<?php

declare(strict_types=1);

namespace Domain\File\Commands;

use App\Services\ThumbCreator;
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
     * @var ThumbCreator
     */
    private $thumbCreator;

    /**
     * UploadFileCommand constructor.
     * @param array $uploadedFiles
     * @param Task $task
     * @param ThumbCreator $thumbCreator
     */
    public function __construct(array $uploadedFiles, Task $task, ThumbCreator $thumbCreator)
    {
        $this->uploadedFiles = $uploadedFiles;
        $this->task = $task;
        $this->thumbCreator = $thumbCreator;
    }

    public function handle(): void
    {
        foreach ($this->uploadedFiles as $uploadedFile) {
            $path = $uploadedFile->store("public/files/{$this->task->id}");

            $this->dispatch(new CreateFileCommand($path, $uploadedFile, $this->task, $this->thumbCreator));
        }
    }
}
