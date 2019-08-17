<?php

namespace App\Http\Controllers;

use App\Partner;
use App\Statement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class StatementController extends Controller
{
    public function index()
    {
//        $transactions = Statement::orderBy('id', 'desc')->paginate(5);
        $desiredSize = Input::get('size');
        if ($desiredSize) {
            $transactions = Statement::take($desiredSize)->get();
        } else {
            $transactions = Statement::all();
        }
        return response()->json([
            'message' => 'success',
            'data' => $transactions
        ], 200);
    }

    public function show(Statement $statement)
    {
        return response()->json([
            'message' => 'success',
            'data' => $statement
        ], 200);
    }

    public function store(Request $request)
    {
        $statement = Statement::create($request->all());
        $user = Auth::user();
        if ($statement->transaction_type == '1') {
            $user->mp_amount = $user->mp_amount + $request['mp_amount'];
        } else {
            $user->mp_amount = $user->mp_amount - $request['mp_amount'];
        }
        $user->save();
        return response()->json([
            'message' => 'success',
            'data' => $statement
        ], 201);
    }

    public function update(Request $request, Statement $statement)
    {
        $statement->update($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $statement
        ], 200);
    }

    public function delete(Statement $statement)
    {
        $statement->delete();
        return response()->json([
            'message' => "Success",
            'message' => 'delete success'
        ], 204);
    }

    public function partner(Statement $statement)
    {
//        $id = $statement->partner_id;
//        $partner = Partner::where('custom_id', $id)->first();
        return response()->json([
            'message' => 'success',
            'data' => $statement->partner
        ], 200);
    }

    public function reward(Statement $statement)
    {
        return response()->json([
            'message' => 'success',
            'data' => $statement->reward
        ], 200);
    }

    public function transactionType(Statement $statement)
    {
        return response()->json([
            'message' => 'success',
            'data' => $statement->transactionType
        ], 200);
    }


}
