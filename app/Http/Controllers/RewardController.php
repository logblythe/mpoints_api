<?php

namespace App\Http\Controllers;

use App\Reward;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RewardController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:api');
//        $this->middleware('check_role');
//    }

    public function index()
    {
        $desiredSize = Input::get('size');
        if (!$desiredSize) {
            $rewards = Reward::orderBy('id', 'desc')->paginate(6);
        } else {
            $rewards = Reward::with('partner')->take($desiredSize)->get();
        }


        return response()->json([
            'message' => 'success',
            'data' => $rewards
        ], 200);
    }

    public function show(Reward $reward)
    {
        return response()->json([
            'message' => 'success',
            'data' => $reward
        ], 200);
    }

    public function store(Request $request)
    {
        $reward = Reward::create($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $reward
        ], 201);
    }

    public function update(Request $request, Reward $reward)
    {
        $reward->update($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $reward
        ], 200);
    }

    public function delete(Reward $reward)
    {
        $reward->delete();
        return response()->json([
            'message' => 'delete success'
        ], 204);
    }

    public function category(Reward $reward)
    {
        return response()->json([
            'message' => 'success',
            'data' => $reward->category
        ], 200);
    }

    public function partner(Reward $reward)
    {
//        $id = $reward->partner_id;
//        $partner = Partner::where('custom_id',$id)->first();

        return response()->json([
            'message' => 'success',
            'data' => $reward->partner
        ], 200);
    }

}
