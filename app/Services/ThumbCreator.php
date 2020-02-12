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
        $imageHashName = $this->getImageHashName($uploadedFile->hashName());

        (new ImageManager())
            ->make($path)
            ->resize(self::WIDTH_THUMB, self::HEIGHT_THUMB)
            ->save(str_replace($imageHashName, "{$imageHashName}_thumb", $path));
    }

    /**
     * @param string $hashName
     * @return string
     */
    protected function getImageHashName(string $hashName):string
    {
        $chunks = explode('.', $hashName);

        return (string) array_shift($chunks);
    }
}
