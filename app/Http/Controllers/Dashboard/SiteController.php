<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Site\SiteStoreRequest;
use App\Http\Requests\Dashboard\Site\SiteUpdateRequest;
use App\Repositories\Tenant\TenantInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteController extends Controller
{

    private $repository;

    public function __construct(TenantInterface $repository)
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
        $sites = $this->repository->search($peer_page, $search, null);

        return view('dashboard.site.list', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $edit = false;

        return view('dashboard.site.add', compact('edit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiteStoreRequest $request)
    {
        //  $site = $this->repository->create($request);
        $tenant = \App\Models\Tenant::create([
            'name' =>  $request->name,
            '_tenancy_db_connection'  => Str::slug($request->name),
            'tenancy_db_connection'  => Str::slug($request->name),
            'tenancy_db_name' => $request->db_name,
            'tenancy_db_user' => $request->db_user,
            'tenancy_db_password' => $request->db_password,
            'tenancy_db_host' => $request->db_host,
            'tenancy_db_port' => $request->db_port,
        ]);

        $dbconnection = $tenant->tenancy_db_connection;
        config(['database.connections.'.$dbconnection.'.name' => $tenant->tenancy_db_name]);
        config(['database.connections.'.$dbconnection.'.user' => $tenant->tenancy_db_user]);
        config(['database.connections.'.$dbconnection.'.password' => $tenant->tenancy_db_password]);
        config(['database.connections.'.$dbconnection.'.host' => $tenant->tenancy_db_host]);
        config(['database.connections.'.$dbconnection.'.port' => $tenant->tenancy_db_port]);

        /*tenancy()->
        tenancy()->hook('bootstrapping', function ($tenantManager,$dbconnection) {
            dd($tenantManager,$dbconnection);
            config(['database.connections.'.$dbconnection.'.name' => $tenantManager->getTenant('database_name')]);
            config(['database.connections.'.$dbconnection.'.password' => $tenantManager->getTenant('database_password')]);
            config(['database.connections.'.$dbconnection.'.host' => $tenantManager->getTenant('database_host')]);
        });*/

        $token = $tenant->createToken('apiteste')->plainTextToken;

        return redirect()->route('dashboard.site.index')->withSuccess('Criado com sucesso! Api key: '.$token);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $site = $this->repository->find($id);

        return view('dashboard.site.view', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $site = $this->repository->find($id);
        $edit = true;

        return view('dashboard.site.edit', compact('site', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiteUpdateRequest $request, string $id)
    {
        $site = $this->repository->find($id);
        $site = $this->repository->update($request, $id);

        return redirect()->route('dashboard.site.index')->withSuccess('Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $site = $this->repository->find($id);
        $site->delete();

        return redirect()->route('dashboard.site.index')->withSuccess('Excluído com sucesso!');
    }
}
