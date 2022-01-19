<?php

namespace App\Service\General;

use App\Manager\General\GeneralManager;
use Illuminate\Http\Request;

class GeneralService
{
    private $generalManager;
    public function __construct(GeneralManager $generalManager)
    {
        $this->generalManager=$generalManager;
    }

    public function dashboard(){
        return $this->generalManager->dashboard();
    }

    public function general(){
        return $this->generalManager->general();
    }

    public function generalUpdate(){
        return $this->generalManager->generalUpdate();
    }

    public function about(){
        return $this->generalManager->about();
    }

    public function aboutUpdate(Request $request){
        return $this->generalManager->aboutUpdate($request);
    }

}
