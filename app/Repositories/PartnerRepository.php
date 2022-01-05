<?php

namespace App\Repositories;

use App\Models\Partner\Partner;
use App\Repositories\Interfaces\PartnerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerRepository implements PartnerRepositoryInterface{
    public function index()
   {
       $partner = Partner::orderBy('id','desc')->get();
       return view('admin.partner.index',compact('partner'));
   }

   public function create()
   {
       return view('admin.partner.create');
   }

   public function store(Request $request)
   {
       $partner = new Partner();
       $partner->name = $request->name;
       $partner->link = $request->link;

       $cover = $request->file('cover');

       if($cover){
       $cover_path = $cover->store('images/partner', 'public');

       $partner->cover = $cover_path;
       }

      if ( $partner->save()) {

       return redirect()->route('admin.partner')->with('success', 'partner added successfully');

      } else {

       return redirect()->route('admin.partner.create')->with('error', 'partner failed to add');

      }
   }

   public function show($id)
   {
       //
   }

   public function edit($id)
   {
       $partner = Partner::findOrFail($id);

       return view('admin.partner.edit',compact('partner'));
   }

   public function update(Request $request, $id)
   {
       $partner = Partner::findOrFail($id);
       $partner->name = $request->name;
       $partner->link = $request->link;

       $new_cover = $request->file('cover');

       if($new_cover){
       if($partner->cover && file_exists(storage_path('app/public/' . $partner->cover))){
           Storage::delete('public/'. $partner->cover);
       }

       $new_cover_path = $new_cover->store('images/partner', 'public');

       $partner->cover = $new_cover_path;

       }

      if ( $partner->save()) {

       return redirect()->route('admin.partner')->with('success', 'Data added successfully');

      } else {

       return redirect()->route('admin.partner.create')->with('error', 'Data failed to add');

      }
   }

   public function destroy($id)
   {
       $partner = Partner::findOrFail($id);

       if($partner->cover && file_exists(storage_path('app/public/' . $partner->cover))){
        Storage::delete('public/'. $partner->cover);
    }

       $partner->delete();

       return redirect()->route('admin.partner')->with('success', 'Data deleted successfully');
   }
}
