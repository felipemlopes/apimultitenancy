<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Repositories\Customer\CustomerListInterface;
use App\Transformers\CustomerList\CustomerListTransformer;

use Illuminate\Http\Request;

class CustomersController extends Controller
{
    private $repository;
    public function __construct(CustomerListInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {

        $peer_page = 15;
        $search = request()->get('search');
        $status = request()->get('status');
        $customers = $this->repository->search($peer_page, $search, $status);

        return responder()->success($customers, CustomerListTransformer::class)->respond(200);
    }

    public function store(Request $request)
    {
        $customer = $this->repository->create($request);
        return responder()->success($customer, CustomerListTransformer::class)->respond(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = $this->repository->find($id);
        return responder()->success($customer, CustomerListTransformer::class)->respond(200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customers = $this->repository->update($request, $id);
        return responder()->success($customers, CustomerListTransformer::class)->respond(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customers = $this->repository->delete($id);
        return responder()->success($customers, CustomerListTransformer::class)->respond(200);
    }
    public function  exportCustomers(string $id)
    {
        //
    }
}
