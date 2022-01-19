<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Service\Page\PageService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $pageService;
    public function __construct(PageService $pageService)
    {
        $this->pageService=$pageService;
    }
    public function index(){
        return $this->pageService->index();
    }

    public function create(){
        return $this->pageService->create();
    }

    public function store(Request $request){
        return $this->pageService->store($request);
    }

    public function show($id){
        return $this->pageService->show($id);
    }

    public function edit($id){
        return $this->pageService->edit($id);
    }

    public function update($id){
        return $this->pageService->update($id);
    }

    public function destroy($id){
        return $this->pageService->destroy($id);
    }
}
