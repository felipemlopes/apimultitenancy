<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        /*if(!defined('APIMULTITENANT_URL')) define('APIMULTITENANT_URL',"https://api.sortedemidas.online/api");
        if(!defined('APIMULTITENANT_TOKEN')) define('APIMULTITENANT_TOKEN',"1|nzLXEeSVLTDgxl42v3QE1mi88h5SPO6Jur2ThBVNb2421b4b");

        $product_id = 107;
        $max_numbers = 1000000;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => APIMULTITENANT_URL."/generate_numbers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(array('product_id' => $product_id,'max_numbers' => $max_numbers)),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Accept: application/json",
                'Authorization: Bearer '.APIMULTITENANT_TOKEN
            ],
        ]);

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $err = curl_error($curl);
        dd($response,$info);*/

        if (Auth::Check()) {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login');
    }
}
