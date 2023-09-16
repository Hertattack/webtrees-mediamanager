<?php

namespace Hertattack\Webtrees\Module\MediaManager;

use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleConfigInterface;
use Fisharebest\Webtrees\Module\ModuleConfigTrait;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\View;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MediaManagerModule extends AbstractModule implements
    ModuleCustomInterface,
    ModuleConfigInterface
{
    use ModuleCustomTrait;
    use ModuleConfigTrait;

    public function title(): string
    {
        return I18N::translate("Media Manager");
    }

    public function description(): string
    {
        return I18N::translate('This module aim to improve the handling of media including resizing and being able to see full-size when desired.');
    }

    public function resourcesFolder(): string
    {
        return __DIR__ . '/resources/';
    }

    public function boot(): void
    {
        View::registerNamespace($this->name(), $this->resourcesFolder() . 'views/');
        View::registerCustomView('::admin/manage-media', $this->name() . '::admin/manage-media');
    }
    
    public function getAdminAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->layout = 'layouts/administration';

        return $this->viewResponse('admin/manage-media', [
            'title' => $this->title()
        ]);
    }

    public function isEnabledByDefault(): bool
    {
        return true;
    }
}