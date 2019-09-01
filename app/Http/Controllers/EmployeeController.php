<?php

namespace App\Http\Controllers;

use App\Employee;
use App\PartnerSeller;
use Illuminate\Support\Facades\Input;

class EmployeeController extends Controller
{
    function isPartnerEmp()
    {
        $customId = Input::get('customId');
        $sellerId = Input::get('sellerId');
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
                    if ($partnerSeller->custom_id == $sellerId) {
                        return response()->json([
                            'message' => 'success',
                            'data' => $employee
                        ], 200);
                    }
                    return response()->json([
                        'error' => 'Invalid employee',
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
