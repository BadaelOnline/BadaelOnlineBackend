<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface{

    public function index()
    {
        $category = Category::orderBy('id','desc')->get();
        return view('admin.category.index',compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "name" => "required",
            "keyword" => "required",
            "meta_desc" => "required"
        ])->validate();

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->keyword = $request->keyword;
        $category->meta_desc = $request->meta_desc;

        if ( $category->save()) {

            return redirect()->route('admin.category')->with('success', 'Data added successfully');

           } else {

            return redirect()->route('admin.category')->with('error', 'Data failed to add');

           }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            "name" => "required",
            "keyword" => "required",
            "meta_desc" => "required"
        ])->validate();

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->keyword = $request->keyword;
        $category->meta_desc = $request->meta_desc;

        if ( $category->save()) {

            return redirect()->route('admin.category')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.category')->with('error', 'Data failed to update');

           }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Data deleted successfully');
    }

}
