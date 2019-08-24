<?php

namespace App\Http\Controllers;

use App\PartnerSeller;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PartnerSellerController extends Controller
{
    public function index(){
        return response()->json([
            'message' => 'success',
            'data' => PartnerSeller::all()
        ], 200);
    }
    public function show()
    {
        $customId = Input::get('customId');
        if (!$customId) {
            $seller = PartnerSeller::all();
            return response()->json([
                'message' => 'success',
                'data' => $seller
            ], 200);
        }
        $seller = PartnerSeller::with('partner')->where('custom_id', $customId)->first();
        if (!$seller) {
            return response()->json([
                'error' => 'No seller found',
            ], 200);
        }
        if ($seller->partner->active_inactive == false) {
            return response()->json([
                'error' => 'the partner is not active',
                'data' => [$seller]
            ], 200);
        }
        return response()->json([
            'message' => 'success',
            'data' => $seller
        ], 200);
    }
}
