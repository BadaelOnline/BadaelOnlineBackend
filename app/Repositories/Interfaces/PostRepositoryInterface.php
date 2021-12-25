<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface PostRepositoryInterface{

    public function index();

    public function create();

    public function store(Request $request);

    public function show($id);

    public function edit($id);

    public function update(Request $request, $id);

    public function destroy($id);

    public function trash();

    public function restore($id);

    public function deletePermanent($id);
}
