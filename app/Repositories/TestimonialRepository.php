<?php

namespace App\Repositories;

use App\Models\Testimonial\Testimonial;
use App\Repositories\Interfaces\TestimonialRepositoryInterface;
use Illuminate\Http\Request;

class TestimonialRepository implements TestimonialRepositoryInterface{
    public function index()
    {
        $testi = Testimonial::orderBy('id','desc')->get();

        return view('admin.testi.index',compact('testi'));
    }

    public function create()
    {
        return view('admin.testi.create');
    }

    public function store(Request $request)
    {
        $testi = new Testimonial();
        $testi->name = $request->name;
        $testi->profession = $request->profession;
        $testi->desc = $request->desc;
        $testi->status = 'PUBLISH';

        $photo = $request->file('photo');

        if($photo){

            $cover_path = $photo->store('images/testi', 'public');

            $testi['photo'] = $cover_path;

        }else{
            $testi->photo = 'images/testi/avatar.png';
        }

        if ($testi->save()) {

            return redirect()->route('admin.testi')->with('success', 'Data added successfully');

           } else {

            return redirect()->route('admin.testi.create')->with('error', 'Data failed to add');

           }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $testi = Testimonial::findOrFail($id);

        return view('admin.testi.edit',compact('testi'));
    }

    public function update(Request $request, $id)
    {
        $testi = Testimonial::findOrFail($id);
        $testi->name = $request->name;
        $testi->profession = $request->profession;
        $testi->desc = $request->desc;
        $testi->status = $request->status;

        $photo = $request->file('photo');

        if($photo){

            $cover_path = $photo->store('images/testi', 'public');

            $testi['photo'] = $cover_path;

        }else{
            $testi->photo = 'images/testi/avatar.png';
        }

        if ($testi->save()) {

            return redirect()->route('admin.testi')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.testi.edit')->with('error', 'Data failed to update');

           }
    }

    public function destroy($id)
    {
        $testi = Testimonial::findOrFail($id);

        $testi->delete();

        return redirect()->route('admin.testi')->with('success', 'Data deleted successfully');
    }
}
