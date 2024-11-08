<?php

namespace App\Http\Controllers\ProductList;

use App\Http\Controllers\Controller;
use App\Models\ProductList;
use App\Repositories\ProductList\ProductListInterface;
use App\Transformers\ProductList\ProductListTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductListController extends Controller
{
    private $repository;
    public function __construct(ProductListInterface $repository)
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
        $products = $this->repository->search($peer_page, $search, $status);

        return responder()->success($products, ProductListTransformer::class)->respond(200);
    }

    public function store(Request $request)
    {
        $product = $this->repository->create($request);
        return responder()->success($product, ProductListTransformer::class)->respond(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->repository->find($id);
        return responder()->success($product, ProductListTransformer::class)->respond(200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products = $this->repository->update($request, $id);
        return responder()->success($products, ProductListTransformer::class)->respond(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = $this->repository->delete($id);
        return responder()->success($products, ProductListTransformer::class)->respond(200);
    }

    //sorteios listar

    public function all()
    {

        $products = $this->repository->all();

        return responder()->success($products, ProductListTransformer::class)->respond(200);
    }

    public function participant($id)
    {
        $products = $this->repository->participant($id);
        return responder()->success($products, ProductListTransformer::class)->respond(200);
    }

    public function geralRepor($id)
    {
        $products = $this->repository->geralReport($id);
        return responder()->success($products)->respond(200);
    }

    public function dailyRepor($id)
    {
        $products = $this->repository->dailyReport($id);
        return responder()->success($products, ProductListTransformer::class)->respond(200);
    }
}
