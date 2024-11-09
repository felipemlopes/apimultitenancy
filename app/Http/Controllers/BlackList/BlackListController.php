<?php

namespace App\Http\Controllers\BlackList;

use App\Http\Controllers\Controller;

use App\Repositories\BlackList\BlackListInterface;
use App\Transformers\BlackList\BlackListTransformer;
use Illuminate\Http\Request;

class BlackListController extends Controller
{
    private $repository;

    public function __construct(BlackListInterface $repository)
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
        $blackLists = $this->repository->search($peer_page, $search, $status);

        return responder()->success($blackLists, BlackListTransformer::class)->respond(200);
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blackLists = $this->repository->find($id);

        return responder()->success($blackLists, BlackListTransformer::class)->respond(200);
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
        $blackLists = $this->repository->delete($id);

        return responder()->success()->respond(200);
    }
}
