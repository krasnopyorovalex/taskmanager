<?php

declare(strict_types=1);

namespace Domain\File\Commands;

use App\File;
use App\Services\ThumbCreatorService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Task;
use Illuminate\Http\UploadedFile;
use Storage;

/**
 * Class CreateFileCommand
 * @package Domain\File\Commands
 */
class CreateFileCommand
{
    use DispatchesJobs;

    private const IMAGES_MIME_TYPES = [
        'image/jpeg',
        'image/gif',
        'image/png'
        //'image/bmp',
        //'image/svg+xml'
    ];

    /**
     * @var Task
     */
    private $task;
    /**
     * @var string
     */
    private $path;
    /**
     * @var UploadedFile
     */
    private $uploadedFile;
    /**
     * @var ThumbCreatorService
     */
    private $thumbCreator;

    /**
     * CreateFileCommand constructor.
     * @param string $path
     * @param UploadedFile $uploadedFile
     * @param Task $task
     * @param ThumbCreatorService $thumbCreator
     */
    public function __construct(string $path, UploadedFile $uploadedFile, Task $task, ThumbCreatorService $thumbCreator)
    {
        $this->task = $task;
        $this->path = $path;
        $this->uploadedFile = $uploadedFile;
        $this->thumbCreator = $thumbCreator;
    }

    public function handle(): void
    {
        $file = new File();
        $file->task_id = $this->task->id;
        $file->name = $this->uploadedFile->getClientOriginalName();
        $file->path = $this->path;
        $file->is_image = $this->checkImageByMimeType();

        if ($file->is_image) {
            $this->createThumb();
        }

        $file->save();
    }

    /**
     * @return bool
     */
    protected function checkImageByMimeType(): bool
    {
        return in_array($this->uploadedFile->getMimeType(), self::IMAGES_MIME_TYPES, true);
    }

    protected function createThumb(): void
    {
        $this->thumbCreator->createThumb($this->uploadedFile, Storage::path($this->path));
    }
}
