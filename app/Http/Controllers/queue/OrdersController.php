<?php

namespace App\Http\Controllers\queue;

use App\Http\Controllers\Controller;
use App\Jobs\AprovePayment;
use App\Jobs\PlaceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function placeOrder(Request $request)
    {
        if (!$request->customer_id  or !$request->product_id  or !$request->order_id  or !$request->code  or $request->upersell=="") {
            return response()->json(['message' => 'Please pass correct params'], 400);
        }

        Log::info(json_encode($request->all()));
        Log::info("Place order job started successfully");
        try {
            $endpoint = Auth::User()->name;
            $tenant_id = Auth::User()->id;

            $token = request()->bearerToken();
            PlaceOrder::dispatch($token, $request->customer_id, $request->product_id, $request->order_id, $request->code, $request->upersell,$endpoint);
            return response()->json(['message' => 'Place order job started successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }



    public function approvePayment(Request $request)
    {
        if (!$request->product_id or !$request->quantity) {
            return response()->json(['message' => 'Please pass correct params'], 400);
        }
        try {
            $connection = getTenantConnection();
            $token = request()->bearerToken();
            AprovePayment::dispatch($connection, $request->product_id, $request->quantity,$token);
            return response()->json(['message' => 'approve_payment job started successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
