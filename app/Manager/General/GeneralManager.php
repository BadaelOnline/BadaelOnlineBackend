<?php

namespace App\Manager\General;

use App\Repositories\Interfaces\GeneralRepositoryInterface;
use Illuminate\Http\Request;

class GeneralManager
{
    private $generalRepository;
    public function __construct(GeneralRepositoryInterface $generalRepository)
    {
        $this->generalRepository=$generalRepository;
    }

    public function dashboard(){
        return $this->generalRepository->dashboard();
    }

    public function general(){
        return $this->generalRepository->general();
    }

    public function generalUpdate(){
        return $this->generalRepository->generalUpdate();
    }

    public function about(){
        return $this->generalRepository->about();
    }

    public function aboutUpdate(Request $request){
        return $this->generalRepository->aboutUpdate($request);
    }

}
