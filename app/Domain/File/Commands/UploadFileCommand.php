<?php

declare(strict_types=1);

namespace Domain\File\Commands;

use App\Services\ThumbCreatorService;
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
     * @var ThumbCreatorService
     */
    private $thumbCreator;

    /**
     * UploadFileCommand constructor.
     * @param array $uploadedFiles
     * @param Task $task
     * @param ThumbCreatorService $thumbCreator
     */
    public function __construct(array $uploadedFiles, Task $task, ThumbCreatorService $thumbCreator)
    {
        $this->uploadedFiles = $uploadedFiles;
        $this->task = $task;
        $this->thumbCreator = $thumbCreator;
    }

    public function handle(): void
    {
        foreach ($this->uploadedFiles as $uploadedFile) {
            $year = date('Y');
            $path = $uploadedFile->store("public/files/{$year}/{$this->task->id}");

            $this->dispatch(new CreateFileCommand($path, $uploadedFile, $this->task, $this->thumbCreator));
        }
    }
}
