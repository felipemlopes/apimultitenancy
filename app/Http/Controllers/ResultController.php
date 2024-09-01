<?php

namespace App\Http\Controllers;

use App\Models\CustomerList;
use App\Models\ProductList;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductList::on(Auth::User()->db_connection)->get();

        return response()->json($products,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = ProductList::on(Auth::User()->db_connection)->where('id',$id)->first();
        if(!$product){
            return response()->json(['message'=>'not found'],404);
        }

        return response()->json($product,200);
    }

}
