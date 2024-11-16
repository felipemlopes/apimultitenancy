<?php

namespace App\Http\Controllers\ProductList;

use App\Http\Controllers\Controller;
use App\Models\ProductList;
use App\Repositories\ProductList\ProductListInterface;
use App\Transformers\CotasPremiada\CotasPremiadaTransformer;
use App\Transformers\CustomerList\CustomerListTransformer;
use App\Transformers\LinkCampanha\LinkCampanhaTransformer;
use App\Transformers\OrderList\OrderListTransformer;
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
        return responder()->success()->respond(200);
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
        return responder()->success($products, CustomerListTransformer::class)->respond(200);
    }

    public function geralRepor($id)
    {
        $products = $this->repository->geralReport($id);
        return responder()->success($products)->respond(200);
    }

    public function dailyReport($id)
    {
        $products = $this->repository->dailyReport($id);
        return responder()->success($products)->respond(200);
    }

    public function order($id)
    {
        $products = $this->repository->order($id);
        return responder()->success($products)->respond(200);
    }

    public function cotasPremiadas($id)
    {
        $cotasPremiadas = $this->repository->cotasPremiadas($id);
        return responder()->success($cotasPremiadas, CotasPremiadaTransformer::class)->respond(200);
    }

    public function linkCampanha($id)
    {
        $linksCampanha = $this->repository->linkCampanha($id);
        return responder()->success($linksCampanha, LinkCampanhaTransformer::class)->respond(200);
    }

    public function FindLinkCampanha($id, $link_id)
    {
        $linksCampanhaFind = $this->repository->FindLinkCampanha($id, $link_id);
        return responder()->success($linksCampanhaFind, LinkCampanhaTransformer::class)->respond(200);
    }

    public function StoreLinkCampanha(Request $request, $id)
    {
        $linksCampanhaFind = $this->repository->StoreLinkCampanha($request, $id);
        return responder()->success($linksCampanhaFind, LinkCampanhaTransformer::class)->respond(200);
    }

    public function UpdateLinkCampanha(Request $request, $id, $link_id)
    {
        $updateLinksCampanha = $this->repository->UpdateLinkCampanha($request, $id, $link_id);
        return responder()->success($updateLinksCampanha, LinkCampanhaTransformer::class)->respond(200);
    }


    public function DeleteLinkCampanha($id, $link_id)
    {
        $updateLinksCampanha = $this->repository->DeleteLinkCampanha($id, $link_id);
        return responder()->success()->respond(200);
    }
}
