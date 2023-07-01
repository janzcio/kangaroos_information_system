<?php

namespace App\Http\Controllers\Apis\Kangaroos;

use App\Services\KangarooService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kangaroos\UpdateStoreKangarooRequest;

class KangarooController extends Controller
{
    /**
     * @var KangarooService
     */
    private KangarooService $kangarooService;

    /**
     * @param KangarooService $kangarooService
     */
    public function __construct(KangarooService $kangarooService)
    {
        $this->kangarooService = $kangarooService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kangaroos = $this->kangarooService->getList();

        return $this->generateSuccess($kangaroos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpdateStoreKangarooRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateStoreKangarooRequest $request)
    {
        $kangaroo = $this->kangarooService->create($request->validated());
        
        return $this->generateSuccessCreated($kangaroo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kangaroo  $kangaroo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kangaroo = $this->kangarooService->show($id);

        return $this->generateSuccess($kangaroo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStoreKangarooRequest $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreKangarooRequest $request, $id)
    {
        $this->kangarooService->update($id, $request->validated());

        return $this->generateSuccess([], false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kangaroo  $kangaroo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->kangarooService->delete($id);

        return $this->generateSuccess([], false);
    }
}
