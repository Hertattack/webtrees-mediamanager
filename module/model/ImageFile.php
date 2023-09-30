<?php

namespace Hertattack\Webtrees\Module\MediaManager\model;

use Intervention\Image\Image;

class ImageFile
{
    public readonly string $filePath;
    public readonly int $fileSize;
    public readonly Image $image;

    public function __construct(
        string $filePath, int $fileSize, Image $image)
    {

        $this->filePath = $filePath;
        $this->fileSize = $fileSize;
        $this->image = $image;
    }
}