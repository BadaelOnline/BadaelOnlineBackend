<?php

namespace App\Repositories;

use App\Models\Page\Page;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\PageRepositoryInterface;
use Illuminate\Http\Request;

class PageRepository implements PageRepositoryInterface{

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
        $data = $request->all();

        $data['slug'] = Str::slug(request('title'));

        $page = Page::create($data);

        if ($page) {

                return redirect()->route('admin.page')->with('success', 'Data Berhasil Ditambahkan');

               } else {

                return redirect()->route('admin.page.create')->with('error', 'Data Gagal Ditambahkan');

               }
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
