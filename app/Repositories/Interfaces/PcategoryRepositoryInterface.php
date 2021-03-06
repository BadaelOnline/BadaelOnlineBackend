<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\PCategory\PCategoryRequest;
use Illuminate\Http\Request;

interface PcategoryRepositoryInterface{

    public function index();

    public function store(Request $request);

    public function show($id);

    public function edit($id);

    public function update(Request $request,$id);

    public function destroy($id);
}
