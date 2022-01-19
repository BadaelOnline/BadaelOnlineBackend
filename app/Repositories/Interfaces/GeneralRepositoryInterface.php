<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface GeneralRepositoryInterface{

    public function dashboard();

    public function general();

    public function generalUpdate();

    public function about();

    public function aboutUpdate(Request $request);
}
