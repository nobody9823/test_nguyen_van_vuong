<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait DeleteImage {

    public function deleteImage()
    {
        if (strpos($this->image_url, 'sampleImage') === false){
            \Storage::delete($this->image_url);
        }
    }
}