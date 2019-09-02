<?php

namespace App\Http\Controllers;

use App\Partner;
use App\Statement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class StatementController extends Controller
{
    public function index()
    {
        $userId = Input::get('userId');
        $sellerId = Input::get('sellerId');
        $statements = DB::table('statements')
            ->join('partners', 'statements.partner_id', '=', 'partners.custom_id')
            ->leftJoin('rewards', 'statements.reward_id', '=', 'rewards.custom_id')
            ->select('statements.*', 'partners.business_name', 'partners.image', 'rewards.reward_name')
            ->orderBy('statements.id', 'desc')
            ->where('statements.user_id',$userId)
            ->paginate(10);

        return response()->json([
            'message' => 'success',
            'data' => $statements
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
            $user->sp_amount = $user->sp_amount + $request['sp_amount'];
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
