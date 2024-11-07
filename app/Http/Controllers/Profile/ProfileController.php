<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Repositories\Perfil\PerfilInterface;
use App\Transformers\Perfil\PerfilTransformer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;
    public function __construct(PerfilInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {

        $peer_page = 15;
        $search = request()->get('search');
        $status = request()->get('status');
        $perfis = $this->repository->search($peer_page, $search, $status);

        return responder()->success($perfis, PerfilTransformer::class)->respond(200);
    }

    public function store(Request $request)
    {
        $perfil = $this->repository->create($request);
        return responder()->success($perfil, PerfilTransformer::class)->respond(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perfil = $this->repository->find($id);
        return responder()->success($perfil, PerfilTransformer::class)->respond(200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perfis = $this->repository->update($request, $id);
        return responder()->success($perfis, PerfilTransformer::class)->respond(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perfis = $this->repository->delete($id);
        return responder()->success($perfis, PerfilTransformer::class)->respond(200);
    }
}
