<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SellerController extends Controller
{
    public function show()
    {
        $customId = Input::get('customId');
        $seller = Seller::where('custom_id', $customId)->first();
        if (!$seller) {
            return response()->json([
                'error' => 'No seller found',
                'data' => $seller
            ], 200);
        }
        return response()->json([
            'message' => 'success',
            'data' => [$seller]
        ], 200);
    }
}
