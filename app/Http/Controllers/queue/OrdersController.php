<?php

namespace App\Http\Controllers\queue;

use App\Http\Controllers\Controller;
use App\Jobs\AprovePayment;
use App\Jobs\PlaceOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function placeOrder(Request $request)
    {

        if (!$request->customer_id  or !$request->product_id  or !$request->order_id  or !$request->code  or !$request->upersell) {
            return response()->json(['message' => 'Please pass correct params'], 400);
        }

        try {
            PlaceOrder::dispatch($request->customer_id, $request->product_id, $request->order_id, $request->code, $request->upersell);
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
            AprovePayment::dispatch($request->product_id, $request->quantity);
            return response()->json(['message' => 'Place order job started successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
