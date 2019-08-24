<?php

namespace App\Http\Controllers;

use App\Ad;
use Carbon\Carbon;

class AdController extends Controller
{

    public function index()
    {
        $ads = Ad::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->where('active_inactive', true)
            ->get();
        return response()->json([
            'message' => 'Ads fetch success',
            'data' => $ads
        ]);
    }
}
