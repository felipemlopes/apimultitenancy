<?php

namespace App\Http\Controllers\ProductList;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkCampanha\LinkCampanhaStoreRequest;
use App\Http\Requests\LinkCampanha\LinkCampanhaUpdateRequest;
use App\Http\Requests\ProductList\ProductListStoreRequest;
use App\Http\Requests\ProductList\ProductListUpdateRequest;
use App\Models\ProductList;
use App\Models\Tenant;
use App\Repositories\ProductList\ProductListInterface;
use App\Transformers\CotasPremiada\CotasPremiadaTransformer;
use App\Transformers\CustomerList\CustomerListTransformer;
use App\Transformers\LinkCampanha\LinkCampanhaTransformer;
use App\Transformers\OrderList\OrderListTransformer;
use App\Transformers\ProductList\ProductListTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $token = request()->bearerToken();
        $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
        $tenant = Tenant::find($accessToken->tokenable_id);
        //dd($tenant);
        $dbconnection = Str::slug($tenant->name);
        //dd($dbconnection);
        config(['database.connections.'.$dbconnection.'.driver' => "mysql"]);
        config(['database.connections.'.$dbconnection.'.host' => $tenant->tenancy_db_host]);
        config(['database.connections.'.$dbconnection.'.port' => $tenant->tenancy_db_port]);
        config(['database.connections.'.$dbconnection.'.database' => (string)$tenant->tenancy_db_name]);
        config(['database.connections.'.$dbconnection.'.username' => $tenant->tenancy_db_user]);
        config(['database.connections.'.$dbconnection.'.password' => $tenant->tenancy_db_password]);
        //dd(config('database.connections'));


        $connection = Str::slug($tenant->name);

        $peer_page = 15;
        $search = request()->get('search');
        $status = request()->get('status');
        $products = $this->repository->search($peer_page, $search, $status, $connection);

        return responder()->success($products, ProductListTransformer::class)->respond(200);
    }

    public function store(ProductListStoreRequest $request)
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
    public function update(ProductListUpdateRequest $request, string $id)
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

    public function StoreLinkCampanha(LinkCampanhaStoreRequest $request, $id)
    {
        $linksCampanhaFind = $this->repository->StoreLinkCampanha($request, $id);
        return responder()->success($linksCampanhaFind, LinkCampanhaTransformer::class)->respond(200);
    }

    public function UpdateLinkCampanha(LinkCampanhaUpdateRequest $request, $id, $link_id)
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
