<?php

namespace App\Http\Controllers;

use App\Employee;
use App\PartnerSeller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class EmployeeController extends Controller
{
    function isPartnerEmp()
    {
        $customId = Input::get('customId');
        if ($customId) {
            $employee = Employee::where('custom_id', $customId)->first();
            if ($employee) {
                if ($employee->active_inactive == false) {
                    return response()->json([
                        'error' => 'Employee is not active',
                    ], 200);
                }
                $partnerSeller = PartnerSeller::where('custom_id', $employee->seller_id)->first();
                if ($partnerSeller) {
                    return response()->json([
                        'message' => 'success',
                        'data' => $employee
                    ], 200);
                } else {
                    return response()->json([
                        'error' => 'Not associated with partner seller',
                    ], 200);
                }
            } else {
                return response()->json([
                    'error' => 'Employee doesn\'t exist',
                ], 200);
            }
        }
        return response()->json([
            'error' => 'custom id is required',
        ], 400);

    }
}
