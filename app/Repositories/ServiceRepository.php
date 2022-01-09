<?php

namespace App\Repositories;

use App\Models\Service\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceRepository implements ServiceRepositoryInterface{
    public function index()
    {
        $service = Service::orderBy('id','desc')->get();
        return view('admin.service.index',compact('service'));
    }

    public function create()
    {
        return view('admin.service.create');

    }

    public function store(Request $request)
    {

        Validator::make($request->all(), [
            "icon" => "required",
            "title" => "required",
            "quote" => "required|max:255"
        ])->validate();

        $service = new Service();
        // $service->icon = $request->icon;
        $service->title = $request->title;
        $service->slug = Str::slug(request('title'));
        $service->quote = $request->quote;
        $service->desc = $request->desc;

        $icon = $request->file('icon');

        if($icon){
        $cover_path = $icon->store('images/service', 'public');

        $service->icon = $cover_path;
        }
       if ( $service->save()) {

        return redirect()->route('admin.service')->with('success', 'Data added successfully');

       } else {

        return redirect()->route('admin.service.create')->with('error', 'Data failed to add');

       }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view('admin.service.edit',compact('service'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            "icon" => "required",
            "title" => "required",
            "quote" => "required|max:255"
        ])->validate();

        $service = Service::findOrFail($id);
        // $service->icon = $request->icon;
        $service->title = $request->title;
        $service->slug = Str::slug(request('title'));
        $service->quote = $request->quote;
        $service->desc = $request->desc;

        $new_photo = $request->file('icon');

        if($new_photo){
        if($service->icon && file_exists(storage_path('app/public/' . $service->icon))){
            Storage::delete('public/'. $service->icon);
        }

        $new_cover_path = $new_photo->store('images/service', 'public');

        $service->icon = $new_cover_path;
        }
       if ( $service->save()) {

        return redirect()->route('admin.service')->with('success', 'Data added successfully');

       } else {

        return redirect()->route('admin.service.create')->with('error', 'Data failed to add');

       }
    }

    public function destroy($id)
    {
         $service = Service::findOrFail($id);

        $service->delete();

        return redirect()->route('admin.service')->with('success', 'Data deleted successfully');
    }
}
