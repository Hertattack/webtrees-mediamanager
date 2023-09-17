<?php

namespace Hertattack\Webtrees\Module\MediaManager;

use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleConfigInterface;
use Fisharebest\Webtrees\Module\ModuleConfigTrait;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Services\MediaFileService;
use Fisharebest\Webtrees\View;

use Hertattack\Webtrees\Module\MediaManager\pages\MediaManagerPage;
use Illuminate\Container\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MediaManagerModule extends AbstractModule implements
    ModuleCustomInterface,
    ModuleConfigInterface
{
    use ModuleCustomTrait;
    use ModuleConfigTrait;

    private MediaFileService $mediaFileService;

    public function __construct(MediaFileService $mediaFileService)
    {
        $this->mediaFileService = $mediaFileService;
    }

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
    //    View::registerCustomView('::admin/manage-media', $this->name() . '::admin/manage-media');

    //    Container::getInstance()->bind(MediaManagerPage::class, MediaManagerPage::class);
    }
    
    public function getAdminAction(ServerRequestInterface $request): ResponseInterface
    {
//        $this->layout = 'layouts/administration';
//
//        return $this->viewResponse('admin/manage-media', [
//            'title' => $this->title()
//        ]);

        $page = new MediaManagerPage($this->mediaFileService);
        return $page->handle($request);

        //return redirect(route(MediaManagerPage::class));
    }

    public function isEnabledByDefault(): bool
    {
        return true;
    }
}