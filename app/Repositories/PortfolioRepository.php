<?php

namespace App\Repositories;

use App\Models\Pcategory\Pcategory;
use App\Models\Portfolio\Portfolio;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;

class PortfolioRepository implements PortfolioRepositoryInterface{
    public function index()
    {
        $portfolio = Portfolio::orderBy('id','desc')->get();

        return view('admin.portfolio.index',compact('portfolio'));
    }

    public function create()
    {
        $categories = Pcategory::get();

        return view('admin.portfolio.create',compact('categories'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "cover" => "required",
            "category" => "required",
            "desc" => "required"
        ])->validate();

        $portfolio = new Portfolio();
        $portfolio->pcategory_id = $request->category;
        $portfolio->name = $request->name;
        $portfolio->slug = Str::slug($request->name);
        $portfolio->client = $request->client;
        $portfolio->desc = $request->desc;
        $portfolio->date = $request->date;

        //image desktop
        $cover = $request->file('cover');

        if($cover){
        $cover_path = $cover->store('images/portfolio', 'public');

        $portfolio->cover = $cover_path;
        }

        //image mobile
        $mobileImage = $request->file('mobileImage');

        if($mobileImage){
        $mobileImage_path = $mobileImage->store('images/portfolio', 'public');

        $portfolio->mobileImage = $mobileImage_path;
        }
        if ($portfolio->save()) {

                return redirect()->route('admin.portfolio')->with('success', 'Data added successfully');

               } else {

                return redirect()->route('admin.portfolio.create')->with('error', 'Data failed to add');

               }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $categories = Pcategory::get();

        return view('admin.portfolio.edit',compact('portfolio','categories'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            "category" => "required",
            "desc" => "required"
        ])->validate();

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->pcategory_id = $request->category;
        $portfolio->name = $request->name;
        $portfolio->client = $request->client;
        $portfolio->desc = $request->desc;
        $portfolio->date = $request->date;

        // image desktop
        $new_cover = $request->file('cover');

        if($new_cover){
        if($portfolio->cover && file_exists(storage_path('app/public/' . $portfolio->cover))){
            Storage::delete('public/'. $portfolio->cover);
        }

        $new_cover_path = $new_cover->store('images/portfolio', 'public');

        $portfolio->cover = $new_cover_path;

        }

        // image mobile
        $new_mobileImage = $request->file('mobileImage');

        if($new_mobileImage){
        if($portfolio->mobileImage && file_exists(storage_path('app/public/' . $portfolio->mobileImage))){
            Storage::delete('public/'. $portfolio->mobileImage);
        }

        $new_mobileImage_path = $new_mobileImage->store('images/portfolio', 'public');

        $portfolio->mobileImage = $new_mobileImage_path;

        }

        if ($portfolio->save()) {

                return redirect()->route('admin.portfolio')->with('success', 'Data updated successfully');

               } else {

                return redirect()->route('admin.portfolio.edit')->with('error', 'Data failed to update');

               }
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->delete();

        return redirect()->route('admin.portfolio')->with('success', 'Data deleted successfully');
    }
}
