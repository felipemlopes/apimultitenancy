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

        //try {
            $endpoint = Auth::User()->name;
            Log::info($endpoint);
            Log::info($request->customer_id);
            Log::info($request->product_id);
            Log::info($request->order_id);
            Log::info($request->code);
            Log::info($request->upersell);
            $tenant_id = Auth::User()->id;

            $response = Http::post($endpoint."/classes/Master.php?f=place_order", [
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
                'order_id' => $request->order_id,
                'code' => $request->code
            ]);
            //dd($response->status(),$response->json());

            //$token = request()->bearerToken();
            //PlaceOrder::dispatch($token, $request->customer_id, $request->product_id, $request->order_id, $request->code, $request->upersell,$endpoint);
            return response()->json(['message' => 'Place order job started successfully'], 200);
        /*} catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }*/
    }



    public function approvePayment(Request $request)
    {
        if (!$request->product_id or !$request->quantity) {
            return response()->json(['message' => 'Please pass correct params'], 400);
        }
        try {
            $connection = getTenantConnection();
            AprovePayment::dispatch($connection, $request->product_id, $request->quantity);
            return response()->json(['message' => 'Place order job started successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
