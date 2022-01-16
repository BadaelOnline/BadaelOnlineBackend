<?php

namespace App\Repositories;

use App\Models\Faq\Faq;
use App\Models\Faq\FaqTranslation;
use App\Models\Link\Link;
use App\Models\Link\LinkTranslation;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkRepository implements LinkRepositoryInterface{

    private $link;
    private $linkTranslation;
    public function __construct(Link $link, LinkTranslation $linkTranslation)
    {
        $this->link = $link;
        $this->linkTranslation = $linkTranslation;
    }

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
        try{
            /** transformation to collection */
            // return $request->all();

            $alllinks = collect($request->link)->all();

            // $slug= $request->category['English']['name'];

            $request->is_active ? $is_active = true : $is_active = false;

            DB::beginTransaction();
            // create the default language's banner
            $unTransLink_id = $this->link->insertGetId([
                // 'slug' => $slug ,
                'link' => $request['link'],
                'is_active' => $request->is_active = 1
            ]);

            // check the Category and request
            if(isset($alllinks) && count($alllinks)){
                // insert other translation for Categories
                foreach ($alllinks as $alllink){
                    $transLink_arr[] = [
                        'name' => $alllink ['name'],
                        'local' => $alllink['local'],
                        'link_id' => $unTransLink_id
                    ];
                }

           return     $this->linkTranslation->insert($transLink_arr);
            }
            DB::commit();

            return redirect()->route('admin.link')->with('success', 'Data added successfully');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.link.create')->with('error', 'Data failed to add');
        }
        // $link = new Link();
        // $link->name = $request->name;
        // $link->link = $request->link;

        // if ( $link->save()) {

        //     return redirect()->route('admin.link')->with('success', 'Data added successfully');

        //    } else {

        //     return redirect()->route('admin.link.create')->with('error', 'Data failed to add');

        //    }
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
