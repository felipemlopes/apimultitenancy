<?php

namespace App\Http\Controllers\queue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HealthCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function healthcheck()
    {
        return "Everything is fine.";
    }
}
