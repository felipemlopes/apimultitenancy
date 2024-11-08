<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Repositories\OrderList\OrderListInterface;
use App\Transformers\OrderList\OrderListTransformer;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $repository;
    public function __construct(OrderListInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $peer_page = 15;
        $search = request()->get('search');
        $status = request()->get('status');
        $orders = $this->repository->search($peer_page, $search, $status);

        return responder()->success($orders, OrderListTransformer::class)->respond(200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = $this->repository->find($id);
        return responder()->success($order, OrderListTransformer::class)->respond(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = $this->repository->delete($id);
        return responder()->success($order, OrderListTransformer::class)->respond(200);
    }


    public function Export(string $id)
    {
        $order = $this->repository->delete($id);
        return responder()->success($order, OrderListTransformer::class)->respond(200);
    }
}
