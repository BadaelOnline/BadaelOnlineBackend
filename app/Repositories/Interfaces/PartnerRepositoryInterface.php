<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Partner\PartnerRequest;
use Illuminate\Http\Request;

interface PartnerRepositoryInterface{

    public function index();

   public function create();

   public function store(Request $request);

   public function show($id);

   public function edit($id);

   public function update(Request $request,$id);

   public function destroy($id);
}
