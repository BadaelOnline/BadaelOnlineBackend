<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Faq\FaqRequest;
use Illuminate\Http\Request;

interface FaqRepositoryInterface{

    public function index();

    public function create();

    public function store(Request $request);

    public function show($id);

    public function edit($id);

    public function update(Request $request,$id);

    public function destroy($id);
}
