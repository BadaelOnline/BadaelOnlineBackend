<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Service\Banner\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $bannerService;
    public function __construct(BannerService $bannerService)
    {
        $this->bannerService=$bannerService;
    }
    public function index(){
        return $this->bannerService->index();
    }

    public function create(){
        return $this->bannerService->create();
    }

    public function store(Request $request){
        return $this->bannerService->store($request);
    }

    public function show($id){
        return $this->bannerService->show($id);
    }

    public function edit($id){
        return $this->bannerService->edit($id);
    }

    public function update(Request $request, $id){
        return $this->bannerService->update($request, $id);
    }

    public function destroy($id){
        return $this->bannerService->destroy($id);
    }
}
