<?php

namespace App\Repositories;

use App\Models\Pcategory\Pcategory;
use App\Repositories\Interfaces\PcategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PcategoryRepository implements PcategoryRepositoryInterface{
    public function index()
    {
        $pcategory = Pcategory::orderBy('id','desc')->get();

        return view('admin.pcategory.index',compact('pcategory'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "name" => "required|unique:pcategories"
        ])->validate();

        $pcategory = new Pcategory();
        $pcategory->name = $request->name;

        if ( $pcategory->save()) {

            return redirect()->route('admin.pcategory')->with('success', 'Data added successfully');

           } else {

            return redirect()->route('admin.pcategory')->with('error', 'Data failed to add');

           }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $pcategory = Pcategory::findOrFail($id);

        return view('admin.pcategory.edit',compact('pcategory'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            "name" => "required"
        ])->validate();

        $pcategory = Pcategory::findOrFail($id);
        $pcategory->name = $request->name;

        if ( $pcategory->save()) {

            return redirect()->route('admin.pcategory')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.pcategory.create')->with('error', 'Data failed to update');

           }
    }

    public function destroy($id)
    {
        $pcategory = Pcategory::findOrFail($id);
        $pcategory->delete();

        return redirect()->route('admin.pcategory')->with('success', 'Data deleted successfully');
    }
}
