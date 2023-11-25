<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DivisionWe;
use Illuminate\Http\Request;

class WeAreController extends Controller
{
    public function getAllWeAre()
    {
        $memeber = DivisionWe::with('weare')->orderBy('order','asc')->get();
        return response()->json($memeber);
    }
}
