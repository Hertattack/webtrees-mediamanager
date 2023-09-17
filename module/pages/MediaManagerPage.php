<?php

namespace Hertattack\Webtrees\Module\MediaManager\pages;

use Fisharebest\Webtrees\Http\ViewResponseTrait;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Registry;
use Fisharebest\Webtrees\Services\MediaFileService;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MediaManagerPage implements RequestHandlerInterface
{
    use ViewResponseTrait;

    private MediaFileService $mediaFileService;

    public function __construct(MediaFileService $mediaFileService)
    {
        $this->mediaFileService = $mediaFileService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->layout = 'layouts/administration';

        $data_filesystem      = Registry::filesystem()->data();
        $data_filesystem_name = Registry::filesystem()->dataName();

        $files         = 'local';
        $subfolders    = 'exclude';
        $media_folders = $this->mediaFileService->allMediaFolders($data_filesystem);
        $media_folder  = $media_folders->first();
        $media_types   = Registry::elementFactory()->make('OBJE:FILE:FORM:TYPE')->values();

        $title = I18N::translate('Manage media');

//        return $this->viewResponse('admin/media', [
//            'data_folder'   => $data_filesystem_name,
//            'files'         => $files,
//            'media_folder'  => $media_folder,
//            'media_folders' => $media_folders,
//            'media_types'   => $media_types,
//            'subfolders'    => $subfolders,
//            'title'         => $title,
//        ]);

        return $this->viewResponse('admin/manage-media', [
            'title' => 'Manage Media'
        ]);
    }
}