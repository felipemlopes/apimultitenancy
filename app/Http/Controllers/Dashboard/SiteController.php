<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Site\SiteStoreRequest;
use App\Http\Requests\Dashboard\Site\SiteUpdateRequest;
use App\Repositories\Tenant\TenantInterface;
use Illuminate\Http\Request;

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
        $tenant1 = \App\Models\Tenant::create([
            'name' =>  $request->name,
            'db_connection'  => $request->db_connection,
            'db_name' => $request->db_name,
            'db_user' => $request->db_user,
            'db_password' => $request->db_password,
            'db_host' => $request->db_host,
            'db_port' => $request->db_port,

        ]);

        return redirect()->route('dashboard.site.index')->withSuccess('Criado com sucesso!');
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
