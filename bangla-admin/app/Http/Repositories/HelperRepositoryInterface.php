<?php

namespace App\Http\Repositories;

interface HelperRepositoryInterface
{
    public function imageUpload($image,$date,$waterMark = false):string;
    public function deleteImage($image):void;
}
