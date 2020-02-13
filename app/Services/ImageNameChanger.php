<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Class ImageNameChanger
 * @package App\Services
 */
class ImageNameChanger
{
    /**
     * @param string $path
     * @return mixed
     */
    public function getImageHashNameFromPath(string $path)
    {
        $chunks = explode('/', $path);
        $imageHashName = explode('.', end($chunks));

        return array_shift($imageHashName);
    }

    /**
     * @param string $hashName
     * @return string
     */
    public function getImageHashName(string $hashName):string
    {
        $chunks = explode('.', $hashName);

        return (string) array_shift($chunks);
    }
}
