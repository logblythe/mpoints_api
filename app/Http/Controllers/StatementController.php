<?php

namespace App\Http\Controllers;

use App\Partner;
use App\Statement;
use Illuminate\Http\Request;
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
            'status' => 'success',
            'data' => $transactions
        ], 200);
    }

    public function show(Statement $transaction)
    {
        return response()->json([
            'status' => 'success',
            'data' => $transaction
        ], 200);
    }

    public function store(Request $request)
    {
        $transaction = Statement::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $statement
        ], 201);
    }

    public function update(Request $request, Statement $statement)
    {
        $statement->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $statement
        ], 200);
    }

    public function delete(Statement $statement)
    {
        $statement->delete();
        return response()->json([
            'status' => "Success",
            'message' => 'delete success'
        ], 204);
    }

    public function partner(Statement $statement)
    {
//        $id = $statement->partner_id;
//        $partner = Partner::where('custom_id', $id)->first();
        return response()->json([
            'status' => 'success',
            'data' => $statement->partner
        ], 200);
    }

    public function reward(Statement $statement)
    {
        return response()->json([
            'status' => 'success',
            'data' => $statement->reward
        ], 200);
    }

    public function transactionType(Statement $statement)
    {
        return response()->json([
            'status' => 'success',
            'data' => $statement->transactionType
        ], 200);
    }


}
