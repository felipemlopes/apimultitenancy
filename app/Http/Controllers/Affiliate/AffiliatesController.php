<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Affiliate\AffiliatesStoreRequest;
use App\Http\Requests\Affiliate\AffiliatesUpdateRequest;
use App\Repositories\Affiliate\AffiliateInterface;
use App\Transformers\Affiliate\AffiliateTransformer;
use App\Transformers\AffiliateTransaction\AffiliateTransactionTransformer;
use App\Transformers\OrderList\OrderListTransformer;
use Illuminate\Http\Request;

class AffiliatesController extends Controller
{
    private $repository;

    public function __construct(AffiliateInterface $repository)
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
        $affiliates = $this->repository->search($peer_page, $search, $status);
        return responder()->success($affiliates, AffiliateTransformer::class)->respond(200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(AffiliatesStoreRequest $request)
    {
        $affiliate = $this->repository->create($request);
        return responder()->success($affiliate, AffiliateTransformer::class)->respond(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $affiliate = $this->repository->find($id);
        return responder()->success($affiliate, AffiliateTransformer::class)->respond(200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(AffiliatesUpdateRequest $request, string $id)
    {
        $affiliate = $this->repository->update($request, $id);
        return responder()->success($affiliate, AffiliateTransformer::class)->respond(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $affiliate = $this->repository->delete($id);
        return responder()->success()->respond(200);
    }

    public function wallet(string $id)
    {
        $affiliateTransaction = $this->repository->wallet($id);
        return responder()->success($affiliateTransaction, AffiliateTransactionTransformer::class)->respond(200);
    }

    public function order($id)

    {
        $peer_page = 15;
        $orderList = $this->repository->order($id, $peer_page);
        return responder()->success($orderList, OrderListTransformer::class)->respond(200);
    }
}
