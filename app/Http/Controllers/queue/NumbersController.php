<?php

namespace App\Http\Controllers\queue;

use App\Http\Controllers\Controller;
use App\Jobs\FreeNumbers;
use App\Jobs\GenerateNumbers;
use App\Jobs\HandleNumbersDistribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NumbersController extends Controller
{

    public function generateNumbers(Request $request)
    {
        if (!isset($request->product_id) || !isset($request->max_numbers)) {
            return response()->json(['message' => 'Please pass correct params'], 400);
        }

        try {
            $tenant_id = Auth::User()->id;
            GenerateNumbers::dispatch($request->product_id, $request->max_numbers,$tenant_id);

            return response()->json(['message' => 'Generate numbers job started successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function backNumbers(Request $request)
    {
        if (!$request->product_id  || !$request->numbers_list) {
            return response()->json(['message' => 'Please pass correct params'], 400);
        }

        try {
            HandleNumbersDistribution::dispatch($request->product_id, $request->numbers_lis);

            return response()->json(['message' => 'Back numbers job started successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function freeNumbers()
    {
        try {
            $connection = getTenantConnection();
            FreeNumbers::dispatch($connection);

            return response()->json(['message' => 'Free numbers job started successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function distributeNumbers(Request $request)
    {
        if (!isset($request->product_id) || !isset($request->order_code) || !isset($request->total_required_numbers) || !isset($request->num_digits)) {
            return response()->json(['message' => 'Please pass correct params'], 400);
        }

        try {
            HandleNumbersDistribution::dispatch();

            return response()->json(['message' => 'Free numbers job started successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
