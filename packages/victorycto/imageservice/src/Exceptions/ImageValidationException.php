<?php

namespace victorycto\imageservice\Exceptions;

use Illuminate\Http\UploadedFile;

class ImageValidationException extends \Exception {
    /** @var UploadedFile $uploadedFile */
    public $uploadedFile = null;

    /**
     * @return null
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }

    /**
     * @param null $uploadedFile
     */
    public function setUploadedFile(UploadedFile $uploadedFile): void
    {
        $this->uploadedFile = $uploadedFile;
    }

}
