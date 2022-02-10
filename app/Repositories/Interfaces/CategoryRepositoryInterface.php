<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Banner\BannerRequest;
use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface{

    public function index();

    public function create();

    public function store(Request $request);

    public function show($id);

    public function edit($id);

    public function update($id, Request $request);

    public function destroy($id);
}
