<?php

/**
 * Media Manager Extension Module for Webtrees
 *
 * See https://webtrees.net
 *
 */

declare(strict_types=1);

namespace Hertattack\Webtrees\Module\MediaManager;

require_once __DIR__ . '/Bootstrap.php';

$bootstrap = Bootstrap::Boostrap();

return $bootstrap->module;
