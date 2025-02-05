<?php

namespace App\Http\Controllers\queue;

use App\Http\Controllers\Controller;
use App\Jobs\DeleteCotas;
use App\Jobs\RandomCotas;
use App\Jobs\RegisterCotas;
use App\Jobs\UpdateCotas;
use Illuminate\Http\Request;

class CotasController extends Controller
{


    public function registerCotaPremiada(Request $request)
    {
        if (!$request->product_id  or  !$request->numbers or !$request->active) {
            return response()->json(['message' => 'The following parameters are required: product_id, number, active'], 400);
        }

        if (is_array($request->numbers)) {
            $numbers = $request->numbers;
        } elseif (is_int($request->numbers)) {
            $numbers = [$request->numbers];
        } else {
            return response()->json([
                'message' => "The 'numbers' parameter should be an integer or a List of integers"
            ], 400);
        }

        try {
            RegisterCotas::dispatch($request->product_id, $numbers, $request->active);
            return response()->json(['message' => "Job 'register_cota_premiada' has started successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => "An error occurred while starting 'register_cota_premiada"], 500);
        }
    }


    public function deleteCotaPremiada(Request $request)
    {
        if (!$request->product_id || !$request->numbers) {
            return response()->json(['message' => 'The following parameters are required: product_id, number'], 400);
        }

        if (is_array($request->numbers)) {
            $numbers = $request->numbers;
        } elseif (is_int($request->numbers)) {
            $numbers = [$request->numbers];
        } else {
            return response()->json([
                'message' => "The 'numbers' parameter should be an integer or a List of integers"
            ], 400);
        }
        if (count($request->numbers) == 0) {
            return response()->json(['message' => "The 'numbers' parameter should have at least one item"], 400);
        }

        try {
            DeleteCotas::dispatch($request->product_id, $numbers);
            return response()->json(['message' => "Job 'delete_cota_premiada' has started successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => "An error occurred while starting 'delete_cota_premiada"], 500);
        }
    }

    public function updateCotaPremiada(Request $request)
    {

        if (!$request->product_id || !$request->cota_number) {
            return response()->json(['message' => 'The following parameters are required: product_id, cota_number'], 400);
        }

        if ($request->cota_limit ==  null && $request->active == null) {
            return response()->json(['message' => 'You should provide at least one of the following: active, cota_limit'], 400);
        }

        try {
            UpdateCotas::dispatch($request->product_id, $request->cota_number, $request->cota_limit, $request->active);
            return response()->json(['message' => "Job 'update_cota_premiada' has started successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => "An error occurred while starting 'update_cota_premiada"], 500);
        }
    }

    public function randomCotasPremiadas(Request $request)
    {
        if (!$request->product_id || !$request->quantity) {
            return response()->json(['message' => 'The following parameters are required: product_id, quantity'], 400);
        }

        try {
            RandomCotas::dispatch($request->product_id, $request->quantity);
            return response()->json(['message' => "Job 'random_cotas_premiadas' has started successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => "An error occurred while starting 'random_cotas_premiadas"], 500);
        }
    }
}
