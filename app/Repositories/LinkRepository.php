<?php

namespace App\Repositories;

use App\Models\Link;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use Illuminate\Http\Request;

class LinkRepository implements LinkRepositoryInterface{
    public function index()
    {
        $link = Link::orderBy('id','desc')->get();
        return view('admin.link.index',compact('link'));
    }

    public function create()
    {
        return view('admin.link.create');
    }

    public function store(Request $request)
    {
        $link = new Link();
        $link->name = $request->name;
        $link->link = $request->link;

        if ( $link->save()) {

            return redirect()->route('admin.link')->with('success', 'Data added successfully');

           } else {

            return redirect()->route('admin.link.create')->with('error', 'Data failed to add');

           }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $link = Link::findOrFail($id);
        return view('admin.link.edit',compact('link'));
    }

    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);
        $link->name = $request->name;
        $link->link = $request->link;

        if ( $link->save()) {

            return redirect()->route('admin.link')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.link.create')->with('error', 'Data failed to update');

           }
    }

    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();

        return redirect()->route('admin.link')->with('success', 'Data deleted successfully');
    }
}
