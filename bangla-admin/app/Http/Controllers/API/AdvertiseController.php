<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    public function getAdvertise($type)
    {
        $advertise = Advertise::where('type',$type)->where('status',1)->first();
        return response()->json($advertise);
    }
}
