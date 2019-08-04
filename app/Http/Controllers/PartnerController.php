<?php

namespace App\Http\Controllers;

use App\Category;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PartnerController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth:api');
//        $this->middleware('check_role');
//    }

    public function index()
    {
//        $partners = Partner::orderBy('id', 'desc')->paginate(5);
        $desiredSize = Input::get('size');
        if ($desiredSize) {
            $partners = Partner::take($desiredSize)->get();
        } else {
            $partners = Partner::all();
        }
        return response()->json([
            'status' => 'success',
            'data' => $partners
        ], 200);
    }

    public function show(Partner $partner)
    {
        return response()->json([
            'status' => 'success',
            'data' => $partner
        ], 200);
    }

    public function store(Request $request)
    {
        $partner = Partner::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $partner
        ], 201);
    }

    public function update(Request $request, Partner $partner)
    {
        $partner->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $partner
        ], 200);
    }

    public function delete(Partner $partner)
    {
        $partner->delete();
        return response()->json([
            'status' => "Success",
            'message' => 'delete success'
        ], 204);
    }

    public function category(Partner $partner)
    {
        $category = $partner->category;
        return response()->json([
            'status' => 'Success',
            'data' => $category
        ]);
    }

    public function tags(Partner $partner)
    {
        return response()->json([
            'status' => 'Success',
            'data' => $partner->tags
        ]);
    }

    public function rewards(Partner $partner)
    {
        return response()->json([
            'status' => 'Success',
            'data' => $partner->rewards
        ]);
    }
}