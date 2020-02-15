<?php

declare(strict_types=1);

namespace Domain\File\Commands;

use App\File;
use App\Services\ImageNameChangerService;
use Exception;
use Storage;

/**
 * Class DeleteFileCommand
 * @package Domain\File\Commands
 */
class DeleteFileCommand
{
    private $file;
    /**
     * @var ImageNameChangerService
     */
    private $imageNameChanger;

    /**
     * DeleteFileCommand constructor.
     * @param ImageNameChangerService $imageNameChanger
     * @param File $file
     */
    public function __construct(ImageNameChangerService $imageNameChanger, File $file)
    {
        $this->imageNameChanger = $imageNameChanger;
        $this->file = $file;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function handle(): bool
    {
        Storage::delete($this->file->path);

        if ($this->file->is_image) {
            $imageHashName = $this->imageNameChanger->getImageHashNameFromPath($this->file->path);
            Storage::delete(str_replace($imageHashName, "{$imageHashName}_thumb", $this->file->path));
        }

        return $this->file->delete();
    }
}
