<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function getAllInfo(): \Illuminate\Http\JsonResponse
    {
        $info = Information::all();
        return response()->json($info);
    }
}
