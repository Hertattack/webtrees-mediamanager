<?php

/**
 * Media Manager Extension Module for Webtrees
 *
 * See https://webtrees.net
 *
 */

declare(strict_types=1);

namespace Hertattack\Webtrees\Module\MediaManager;

use Fisharebest\Webtrees\Services\MediaFileService;
use Illuminate\Container\Container;

require __DIR__ . "/MediaManagerModule.php";
require __DIR__ . "/pages/MediaManagerPage.php";


$container = Container::getInstance();

return new MediaManagerModule(
    $container->get(MediaFileService::class)
);
