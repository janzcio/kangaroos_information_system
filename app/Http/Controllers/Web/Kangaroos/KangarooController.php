<?php

namespace App\Http\Controllers\Web\Kangaroos;

use App\Services\KangarooService;
use App\Http\Controllers\Controller;

class KangarooController extends Controller
{
    public function index()
    {
        return view('pages.kangaroos.index');
    }

    public function create()
    {
        return view('pages.kangaroos.create');
    }

    public function edit($id , KangarooService $kangarooService)
    {
        $kangaroo = $kangarooService->show($id);

        return view('pages.kangaroos.edit', compact('kangaroo'));
    }
}
