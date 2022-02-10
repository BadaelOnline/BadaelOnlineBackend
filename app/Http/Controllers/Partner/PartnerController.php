<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\PartnerRequest;
use App\Service\Partner\PartnerService;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    private $partnerService;
    public function __construct(PartnerService $partnerService)
    {
        $this->partnerService=$partnerService;
    }
    public function index(){
        return $this->partnerService->index();
    }

    public function create(){
        return $this->partnerService->create();
    }

    public function store(Request $request){
        return $this->partnerService->store($request);
    }

    public function show($id){
        return $this->partnerService->show($id);
    }

    public function edit($id){
        return $this->partnerService->edit($id);
    }

    public function update(Request $request,$id){
        return $this->partnerService->update($request,$id);
    }

    public function destroy($id){
        return $this->partnerService->destroy($id);
    }

}
