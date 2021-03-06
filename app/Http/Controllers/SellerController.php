<?php

namespace App\Http\Controllers;

use App\PartnerSeller;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SellerController extends Controller
{
    public function show()
    {
        return response()->json([
            'message' => 'success',
            'data' => Seller::all()
        ], 200);
        $customId = Input::get('customId');
        if (!$customId) {
            $seller = Seller::all();
            return response()->json([
                'message' => 'success',
                'data' => $seller
            ], 200);
        }
        $seller = Seller::where('custom_id', $customId)->first();
        if (!$seller) {
            return response()->json([
                'error' => 'No seller found',
                'data' => $seller
            ], 200);
        }
//        if ($seller->partner->active_inactive == false) {
//            return response()->json([
//                'error' => 'the partner is not active',
//                'data' => [$seller]
//            ], 200);
//        }
        return response()->json([
            'message' => 'success',
            'data' => [$seller]
        ], 200);
    }
}
