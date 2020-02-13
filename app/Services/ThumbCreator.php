<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;

/**
 * Class ThumbCreator
 * @package App\Services
 */
class ThumbCreator
{
    /**
     * @var ImageNameChanger
     */
    private $imageNameChanger;

    public function __construct(ImageNameChanger $imageNameChanger)
    {
        $this->imageNameChanger = $imageNameChanger;
    }

    /**
     * @var int
     */
    private const WIDTH_THUMB = 180;
    /**
     * @var int
     */
    private const HEIGHT_THUMB = 180;

    /**
     * @param UploadedFile $uploadedFile
     * @param string $path
     */
    public function createThumb(UploadedFile $uploadedFile, string $path): void
    {
        $imageHashName = $this->imageNameChanger->getImageHashName($uploadedFile->hashName());

        (new ImageManager())
            ->make($path)
            ->resize(self::WIDTH_THUMB, self::HEIGHT_THUMB)
            ->save(str_replace($imageHashName, "{$imageHashName}_thumb", $path));
    }

    /**
     * @return ImageNameChanger
     */
    public function getImageNameChanger(): ImageNameChanger
    {
        return $this->imageNameChanger;
    }
}
