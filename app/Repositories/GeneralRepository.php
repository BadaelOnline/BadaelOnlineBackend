<?php

namespace App\Repositories;

use App\Models\About\About;
use App\Models\General\General;
use App\Models\General\GeneralTranslation;
use App\Models\Page\Page;
use App\Repositories\Interfaces\GeneralRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Post\Post;
use App\Models\Team\Team;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GeneralRepository implements GeneralRepositoryInterface{

    private $request;
    private $post;
    private $page;
    private $user;
    private $team;
    private $about;
    private $general;
    private $generalTranslation;
    public function __construct(General $general, GeneralTranslation $generalTranslation, User $user, Team $team, Page $page, Post $post, About $about ,Request $request)
    {
        $this->request = $request;
        $this->post = $post;
        $this->page = $page;
        $this->user = $user;
        $this->team = $team;
        $this->about = $about;
        $this->general = $general;
        $this->generalTranslation = $generalTranslation;
    }

    public function dashboard(){
        $admin = $this->user::count();
        $team = $this->team::count();
        $blog = $this->post::count();
        $page = $this->page::count();
        return view ('admin.dashboard', compact('admin','blog','page','team'));
    }

    public function general(){
        $general = $this->general::find(1);
        return view ('admin.general',[
            'general' => $general
        ]);
    }

    public function generalUpdate()
    {
        try{
            $general = $this->general::find(1);
            $id = $general->id;

            $new_logo = $this->request->file('logo');

            if($new_logo){
                if($this->request->logo && file_exists(storage_path('app/public/' . $this->request->logo))){
                    Storage::delete('public/'. $this->request->logo);
                }
                $new_logo_path = $new_logo->store('images/general', 'public');
            }

            $new_favicon = $this->request->file('favicon');

            if($new_favicon){
                if($this->request->favicon && file_exists(storage_path('app/public/' . $this->request->favicon))){
                    Storage::delete('public/'. $this->request->favicon);
                }
                $new_favicon_path = $new_favicon->store('images/general', 'public');
            }

            DB::beginTransaction();
            // //create the default language's ggeneral
            $unTransGeneral_id = $this->general->where('generals.id', $id)
                ->update([
                    'favicon' => $new_favicon_path,
                    'logo' => $new_logo_path,
                    'phone' => $this->request['phone'],
                    'email' => $this->request['email'],
                    'twitter' => $this->request['twitter'],
                    'facebook' => $this->request['facebook'],
                    'instagram' => $this->request['instagram'],
                    'linkedin' => $this->request['linkedin'],
                    'gmaps' => $this->request['gmaps'],
                    'is_active' => $this->request->is_active = 1,
            ]);

            $allgenerals = array_values($this->request->general);
                //insert other translations for General
                foreach ($allgenerals as $allgeneral) {
                    $this->generalTranslation->where('general_id', $id)
                    ->where('local', $allgeneral['local'])
                    ->update([
                        'title' => $allgeneral ['title'],
                        'local' => $allgeneral['local'],
                        'address1' => $allgeneral['address1'],
                        'address2' => $allgeneral['address2'],
                        'footer' => $allgeneral['footer'],
                        'tawkto' => $allgeneral['tawkto'],
                        'disqus' => $allgeneral['disqus'],
                        'gverification' => $allgeneral['gverification'],
                        'sharethis' => $allgeneral['sharethis'],
                        'keyword' => $allgeneral['keyword'],
                        'meta_desc' => $allgeneral['meta_desc'],
                        'general_id' =>  $id
                    ]);
                }
            DB::commit();
            return redirect()->route('admin.general')->with('success', 'Data updated successfully');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.general')->with('error', 'Data failed to update');
        }
    }

    public function about()
    {
        $about = $this->about::find(1);
        return view ('admin.about',[
            'about' => $about
        ]);
    }

    public function aboutUpdate(Request $request)
    {
        $about = $this->about::find(1);
        $about->title = $request->title;
        $about->subject = $request->subject;
        $about->desc = $request->desc;

        if ( $about->save()) {

            return redirect()->route('admin.about')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.about')->with('error', 'Data failed to update');

           }

    }
}
