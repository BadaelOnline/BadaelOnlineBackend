<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Service\Tag\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private $tagService;
    public function __construct(TagService $tagService)
    {
        $this->tagService=$tagService;
    }
    public function index(){
        return $this->tagService->index();
    }

    public function create(){
        return $this->tagService->create();
    }

    public function store(Request $request){
        return $this->tagService->store($request);
    }

    public function show($id){
        return $this->tagService->show($id);
    }

    public function edit($id){
        return $this->tagService->edit($id);
    }

    public function update(Request $request, $id){
        return $this->tagService->update($request, $id);
    }

    public function destroy($id){
        return $this->tagService->destroy($id);
    }
}
