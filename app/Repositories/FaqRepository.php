<?php

namespace App\Repositories;

use App\Models\Faq\Faq;
use App\Repositories\Interfaces\FaqRepositoryInterface;
use Illuminate\Http\Request;

class FaqRepository implements FaqRepositoryInterface{

    public function index()
    {
        $faq = Faq::orderBy('id','desc')->get();

        return view('admin.faq.index',compact('faq'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        if ( $faq->save()) {

            return redirect()->route('admin.faq')->with('success', 'Data added successfully');

           } else {

            return redirect()->route('admin.faq.create')->with('error', 'Data failed to add');

           }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faq.edit',compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        if ( $faq->save()) {

            return redirect()->route('admin.faq')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.faq.create')->with('error', 'Data failed to update');

           }
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);

        $faq->delete();

        return redirect()->route('admin.faq')->with('success', 'Data deleted successfully');
    }
}
