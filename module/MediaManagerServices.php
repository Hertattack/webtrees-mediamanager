<?php

namespace Hertattack\Webtrees\Module\MediaManager;

use Fisharebest\Webtrees\Services\MediaFileService;
use Illuminate\Container\Container;
use Intervention\Image\ImageManager;
use RuntimeException;

class MediaManagerServices
{
    private const INTERVENTION_DRIVERS = ['imagick', 'gd'];

    public readonly MediaFileService $mediaFileService;
    public readonly ImageManager $imageManager;

    public function __construct(Container $container)
    {
        $this->mediaFileService = $container->get(MediaFileService::class);
        $this->imageManager = $this->imageManager();
    }

    private  function imageManager(): ImageManager
    {
        foreach (static::INTERVENTION_DRIVERS as $driver) {
            if (extension_loaded($driver)) {
                return new ImageManager(['driver' => $driver]);
            }
        }

        throw new RuntimeException('No PHP graphics library is installed.  Need Imagick or GD');
    }
}