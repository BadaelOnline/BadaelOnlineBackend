<?php

namespace App\Repositories;

use App\Models\Service\Service;
use App\Models\Service\ServiceTranslation;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceRepository implements ServiceRepositoryInterface{

    private $service;
    private $serviceTranslation;
    public function __construct(Service $service, ServiceTranslation $serviceTranslation)
    {
        $this->service = $service;
        $this->serviceTranslation = $serviceTranslation;
    }

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
        try{
            /** transformation to collection */
            $allservices = collect($request->service)->all();

            $slug= $request->service['English']['title'];

            $icon = $request->file('icon');
            if($icon){
            $icon_path = $icon->store('images/service', 'public');
            // $coverName= 'images/banner'. 'public' . '/' .$cover-> getClientOriginalName();
            }

            $request->is_active ? $is_active = true : $is_active = false;

            DB::beginTransaction();
            // create the default language's banner
            $unTransService_id = $this->service->insertGetId([
                'slug' => $slug ,
                'icon' => $icon_path,
                'is_active' => $request->is_active = 1
            ]);

            // check the Category and request
            if(isset($allservices) && count($allservices)){
                // insert other translation for Categories
                foreach ($allservices as $allservice){
                    $transService_arr[] = [
                        'title' => $allservice ['title'],
                        'local' => $allservice['local'],
                        'quote' => $allservice['quote'],
                        'desc' => $allservice['desc'],
                        'service_id' => $unTransService_id
                    ];
                }

                $this->serviceTranslation->insert($transService_arr);
            }
            DB::commit();

            return redirect()->route('admin.service')->with('success', 'Data added successfully');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.service.create')->with('error', 'Data failed to add');
        }
    //     Validator::make($request->all(), [
    //         "icon" => "required",
    //         "title" => "required",
    //         "quote" => "required|max:255"
    //     ])->validate();

    //     $service = new Service();
    //     // $service->icon = $request->icon;
    //     $service->title = $request->title;
    //     $service->slug = Str::slug(request('title'));
    //     $service->quote = $request->quote;
    //     $service->desc = $request->desc;

    //     $icon = $request->file('icon');

    //     if($icon){
    //     $cover_path = $icon->store('images/service', 'public');

    //     $service->icon = $cover_path;
    //     }
    //    if ( $service->save()) {

    //     return redirect()->route('admin.service')->with('success', 'Data added successfully');

    //    } else {

    //     return redirect()->route('admin.service.create')->with('error', 'Data failed to add');

    //    }
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
