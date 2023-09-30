<?php

namespace Hertattack\Webtrees\Module\MediaManager\pages;

use Fisharebest\Webtrees\Factories\ImageFactory;
use Fisharebest\Webtrees\Http\ViewResponseTrait;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Registry;
use Fisharebest\Webtrees\Services\MediaFileService;

use Hertattack\Webtrees\Module\MediaManager\model\ImageFile;
use Intervention\Image\ImageManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MediaManagerPage implements RequestHandlerInterface
{
    use ViewResponseTrait;

    private MediaFileService $mediaFileService;
    private ImageManager $imageManager;

    public function __construct(MediaFileService $mediaFileService, ImageManager $imageManager)
    {
        $this->mediaFileService = $mediaFileService;
        $this->imageManager = $imageManager;
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

        $filesOnDisk = $this->mediaFileService->allFilesOnDisk(
            filesystem: $data_filesystem,folder: $media_folder, subfolders: true);

//        return $this->viewResponse('admin/media', [
//            'data_folder'   => $data_filesystem_name,
//            'files'         => $files,
//            'media_folder'  => $media_folder,
//            'media_folders' => $media_folders,
//            'media_types'   => $media_types,
//            'subfolders'    => $subfolders,
//            'title'         => $title,
//        ]);

        $sample = $filesOnDisk->first();
        $image = $this->imageManager->make($data_filesystem->readStream($sample));

        $imageFile = new ImageFile(
            $sample,
            $data_filesystem->fileSize($sample),
            $image);


        return $this->viewResponse('admin/manage-media', view_data: [
            'title' => 'Manage Media',
            'mediaFolders' => $media_folders,
            'filesOnDisk' => $filesOnDisk,
            'imageManager' => $this->imageManager,
            'imageFile' => $imageFile
        ]);
    }
}