<?php
namespace victorycto\imageservice\Models;

use Illuminate\Support\Facades\Storage;

class Image extends \Illuminate\Database\Eloquent\Model
{
    public function getImageUrl($size='full')
    {
        $image_upload_path_prefix = config("imageservice.image_upload_path_prefix");
        $fileSizes = config("imageservice.image_sizes");
        $storage_disk = config("imageservice.storage_disk");
        if (empty($fileSizes[$size])) {
            $size = 'full';
        }
        $fullpath_filename = $image_upload_path_prefix . '/' . $size . '/' . $this->filename;
        if ($storage_disk == 's3') {
            //$url = Storage::disk('s3')->url($fullpath_filename);
            https://victoryimages.s3-us-west-2.amazonaws.com/images/thumbnail/874dc2146afc0fd2ca0bf0603fa0a1d9_homer.jpg
            $url = 'https://'.env('AWS_BUCKET').'.s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . ltrim($fullpath_filename, '/');
            return $url;
        }
        return $fullpath_filename;
    }
}
