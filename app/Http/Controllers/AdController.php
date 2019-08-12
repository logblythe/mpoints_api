<?php

namespace App\Http\Controllers;

use App\Ad;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function index()
    {
        $ads = Ad::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->get();
        return response()->json([
            'message' => 'Ads fetch success',
            'data' => $ads
        ]);
    }
}
