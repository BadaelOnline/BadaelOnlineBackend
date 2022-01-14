<?php

namespace App\Repositories;

use App\Models\Testimonial\Testimonial;
use App\Models\Testimonial\TestimonialTranslation;
use App\Repositories\Interfaces\TestimonialRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialRepository implements TestimonialRepositoryInterface{

    private $testimonial;
    private $testimonialTranslation;
    public function __construct(Testimonial $testimonial, TestimonialTranslation $testimonialTranslation)
    {
        $this->testimonial = $testimonial;
        $this->testimonialTranslation = $testimonialTranslation;
    }

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
        try{
            /** transformation to collection */
            $alltestimoniales = collect($request->testimonial)->all();

            $photo = $request->file('photo');
            if($photo){
            $photo_path = $photo->store('images/testi', 'public');
            }

            $request->is_active ? $is_active = true : $is_active = false;

            DB::beginTransaction();
            // create the default language's banner
            $unTransTestimonial_id = $this->testimonial->insertGetId([
                'status' => $request->status = 'PUBLISH',
                'photo' => $photo_path,
                'is_active' => $request->is_active = 1
            ]);

            // check the Category and request
            if(isset($alltestimoniales) && count($alltestimoniales)){
                // insert other translation for Categories
                foreach ($alltestimoniales as $alltestimonial){
                    $transTestimonial_arr[] = [
                        'name' => $alltestimonial ['name'],
                        'local' => $alltestimonial['local'],
                        'profession' => $alltestimonial['profession'],
                        'desc' => $alltestimonial['desc'],
                        'testimonial_id' => $unTransTestimonial_id
                    ];
                }

                $this->testimonialTranslation->insert($transTestimonial_arr);
            }
            DB::commit();

            return redirect()->route('admin.testi')->with('success', 'Data added successfully');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.testi.create')->with('error', 'Data failed to add');
        }
        // $testi = new Testimonial();
        // $testi->name = $request->name;
        // $testi->profession = $request->profession;
        // $testi->desc = $request->desc;
        // $testi->status = 'PUBLISH';

        // $photo = $request->file('photo');

        // if($photo){

        //     $cover_path = $photo->store('images/testi', 'public');

        //     $testi['photo'] = $cover_path;

        // }else{
        //     $testi->photo = 'images/testi/avatar.png';
        // }

        // if ($testi->save()) {

        //     return redirect()->route('admin.testi')->with('success', 'Data added successfully');

        //    } else {

        //     return redirect()->route('admin.testi.create')->with('error', 'Data failed to add');

        //    }

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
