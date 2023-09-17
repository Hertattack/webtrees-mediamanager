<?php

namespace Hertattack\Webtrees\Module\MediaManager;

require_all_once("/lib/*.php");
require_once __DIR__ . "/MediaManagerServices.php";
require_once __DIR__ . "/MediaManagerModule.php";
require_all_once('/pages/*.php');

use Illuminate\Container\Container;

class Bootstrap
{
    public readonly MediaManagerServices $services;
    public readonly MediaManagerModule $module;

    private function __construct(
        MediaManagerServices $services,
        MediaManagerModule $module)
    {
        $this->services = $services;
        $this->module = $module;
    }

    public static function Boostrap(): Bootstrap
    {
        $container = Container::getInstance();
        $services = new MediaManagerServices($container);
        $module = new MediaManagerModule($services);

        return new Bootstrap($services, $module);
    }
}

function require_all_once(string $relativePattern): void
{
    $scripts = glob( __DIR__ . $relativePattern);
    foreach ($scripts as $script) {
        require_once($script);
    }
}