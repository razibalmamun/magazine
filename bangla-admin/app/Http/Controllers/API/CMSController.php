<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function cms($type)
    {
        $cms = CMS::where('type',$type)->first();
        return response()->json($cms);
    }
}
