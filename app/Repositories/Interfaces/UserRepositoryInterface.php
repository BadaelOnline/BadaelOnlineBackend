<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\User\UserRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface{
    
    public function index();

    public function create();

    public function store(UserRequest $request);

    public function show($id);

    public function edit($id);

    public function update(UserRequest $request, $id);

    public function changepassword(UserRequest $request, $id);

    public function destroy($id);
}
