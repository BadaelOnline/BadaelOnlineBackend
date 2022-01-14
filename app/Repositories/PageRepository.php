<?php

namespace App\Repositories;

use App\Models\Page\Page;
use App\Models\Page\PageTranslation;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\PageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageRepository implements PageRepositoryInterface{

    private $page;
    private $pageTranslation;
    public function __construct(Page $page, PageTranslation $pageTranslation)
    {
        $this->page = $page;
        $this->pageTranslation = $pageTranslation;
    }

    public function index()
    {
        $page = Page::all();
        return view ('admin.page.index', compact('page'));
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(Request $request)
    {
        try{
            /** transformation to collection */
            $allpages = collect($request->page)->all();

            $slug= $request->page['English']['title'];

            $request->is_active ? $is_active = true : $is_active = false;

            DB::beginTransaction();
            // create the default language's banner
            $unTransPage_id = $this->page->insertGetId([
                'slug' => $slug ,
                'is_active' => $request->is_active = 1
            ]);

            // check the Category and request
            if(isset($allpages) && count($allpages)){
                // insert other translation for Categories
                foreach ($allpages as $allpage){
                    $transPage_arr[] = [
                        'title' => $allpage ['title'],
                        'local' => $allpage['local'],
                        'text' => $allpage['text'],
                        'page_id' => $unTransPage_id
                    ];
                }

                $this->pageTranslation->insert($transPage_arr);
            }
            DB::commit();

            return redirect()->route('admin.page')->with('success', 'Data added successfully');
        }catch(\Exception $ex){
            DB::rollback();
            // return $ex->getMessage();
            return redirect()->route('admin.page.create')->with('error', 'Data failed to add');
        }
        // $data = $request->all();

        // $data['slug'] = Str::slug(request('title'));

        // $page = Page::create($data);

        // if ($page) {

        //         return redirect()->route('admin.page')->with('success', 'Data Berhasil Ditambahkan');

        //        } else {

        //         return redirect()->route('admin.page.create')->with('error', 'Data Gagal Ditambahkan');

        //        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view ('admin.page.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $data = $request->all();
//
        $data['slug'] = Str::slug(request('title'));

        $update = $page->update($data);

        if ($update) {

                return redirect()->route('admin.page')->with('success', 'Data Berhasil Diperbarui');

               } else {

                return redirect()->route('admin.page.edit')->with('error', 'Data Gagal Diperbarui');

               }
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        return redirect()->route('admin.page')->with('success', 'Data Berhasil Dihapus');
    }
}
