<?php

namespace victorycto\imageservice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\UploadedFile;
use victorycto\imageservice\Models\Image as ImageModel;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;


use victorycto\imageservice\Exceptions\ImageValidationException;

class imageservice
{
    /*
        - Accept a multipart form image upload
        - Resize / Recompress the image to at least 3 sizes (think thumbnail, small and full). You may change the image format and compression to best suite use on a website
        - Store the image to S3 or GCP cloud storage and create a public url - ideally with a CDN frontend
        - Save the image data to a table of your design in the local mysql database
        - Make the image available to the frontend
     */

    /**
     * @param UploadedFile $file
     * @param string $title
     * @return ImageModel
     * @throws ImageValidationException
     */
    public function saveImage(UploadedFile $file, $title="")
    {
        $this->validateImage($file);
        $extension = $file->getClientOriginalExtension();
        $filename = md5(time()).'_'.$file->getClientOriginalName();
        $image_upload_path_prefix = config("imageservice.image_upload_path_prefix", "/var/www/html/images/");
        $storage_disk = config("imageservice.storage_disk", "s3");
        $managerManager = new ImageManager(array('driver' => 'imagick'));
        $image = $managerManager->make($file)->encode($extension);
        $fullpath_filename = $image_upload_path_prefix . '/' . 'full' . '/' . $filename;
        Storage::disk($storage_disk)->put($fullpath_filename, (string)$image, 'public');
        $imageModel = new ImageModel();
        $imageModel->client_original_name = $file->getClientOriginalName();
        $imageModel->extension = $extension;
        $imageModel->filename = $filename;
        $imageModel->title = $title;
        $imageModel->path_prefix = $image_upload_path_prefix;
        $imageModel->fullpath_filename = $fullpath_filename;
        $imageModel->url = $imageModel->getImageUrl();
        $imageModel->save();
        $fileSizes = config("imageservice.image_sizes");
        foreach ($fileSizes as $sizeName=>$size) {
            $image = $managerManager->make($file)->resize($size['width'], $size['height'])->encode($extension);
            $fullpath_filename = $image_upload_path_prefix . '/' . $sizeName . '/' . $filename;
            Storage::disk($storage_disk)->put($fullpath_filename, (string)$image, 'public');
        }
        return $imageModel;
    }

    /**
     * @param UploadedFile $file
     * @return bool
     * @throws ImageValidationException
     */
    public function validateImage(UploadedFile $file) {
        $image_max_size = config("imageservice.image_max_size");
        $image_extensions = config("imageservice.image_extensions");
        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, $image_extensions)) {
            $e = new ImageValidationException("Invalid image type: $extension ");
            $e->setUploadedFile($file);
            throw $e;
        }
        if ($file->getSize() > $image_max_size) {
            $e = new ImageValidationException("Image too large. Max size: $image_max_size" );
            $e->setUploadedFile($file);
            throw $e;
        }
        return true;
    }
}
