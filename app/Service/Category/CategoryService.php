<?php

namespace App\Service\Category;

use App\Manager\Category\CategoryManager;
use Illuminate\Http\Request;

class CategoryService
{
    private $categoryManager;
    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }
    public function index(){
        return $this->categoryManager->index();
    }

    public function create(){
        return $this->categoryManager->create();
    }

    public function store(Request $request){
        return $this->categoryManager->store($request);
    }

    public function show($id){
        return $this->categoryManager->show($id);
    }

    public function edit($id){
        return $this->categoryManager->edit($id);
    }

    public function update(Request $request, $id){
        return $this->categoryManager->update($request, $id);
    }

    public function destroy($id){
        return $this->categoryManager->destroy($id);
    }
}
