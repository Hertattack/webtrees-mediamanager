<?php

namespace Hertattack\Webtrees\Module\MediaManager;

use Fisharebest\Webtrees\Services\MediaFileService;
use Illuminate\Container\Container;

class MediaManagerServices
{
    public readonly MediaFileService $mediaFileService;

    public function __construct(Container $container)
    {
        $this->mediaFileService = $container->get(MediaFileService::class);
    }
}