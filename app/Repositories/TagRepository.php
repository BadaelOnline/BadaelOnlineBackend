<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TagRepository implements TagRepositoryInterface{
    public function index()
    {
        $tag = Tag::orderBy('id','desc')->get();

        return view('admin.tag.index',compact('tag'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "name" => "required|unique:tags",
            "keyword" => "required",
            "meta_desc" => "required"
        ])->validate();

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->keyword = $request->keyword;
        $tag->meta_desc = $request->meta_desc;

        if ( $tag->save()) {

            return redirect()->route('admin.tag')->with('success', 'Data added successfully');

           } else {

            return redirect()->route('admin.tag')->with('error', 'Data failed to add');

           }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit',compact('tag'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            "name" => "required|unique:tags",
            "keyword" => "required",
            "meta_desc" => "required"
        ])->validate();

        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->keyword = $request->keyword;
        $tag->meta_desc = $request->meta_desc;

        if ( $tag->save()) {

            return redirect()->route('admin.tag')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.tag')->with('error', 'Data failed to update');

           }
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('admin.tag')->with('success', 'Data deleted successfully');
    }
}
