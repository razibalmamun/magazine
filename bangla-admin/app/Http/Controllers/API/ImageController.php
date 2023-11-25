<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getAllImage($limit = 10, $skip = 0): \Illuminate\Http\JsonResponse
    {
        $image = Image::skip($skip)->take($limit)->orderBy('id', 'desc')->get();
        return response()->json($image);
    }

    public function getImage($id): \Illuminate\Http\JsonResponse
    {
        $image = Image::find($id);
        return response()->json($image);
    }
}
