<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Service\General\GeneralService;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    private $generalService;
    public function __construct(GeneralService $generalService)
    {
        $this->generalService=$generalService;
    }

    public function dashboard(){
        return $this->generalService->dashboard();
    }

    public function general(){
        return $this->generalService->general();
    }

    public function generalUpdate(){
        return $this->generalService->generalUpdate();
    }

    public function about(){
        return $this->generalService->about();
    }

    public function aboutUpdate(Request $request){
        return $this->generalService->aboutUpdate($request);
    }
}
