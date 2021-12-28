<?php

namespace App\Repositories;

use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface{
    public function index()
    {
        $post = Post::orderBy('id','desc')->get();

        return view('admin.post.index',compact('post'));
    }

    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('admin.post.create',compact('categories','tags'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "title" => "required",
            "cover" => "required",
            "body" => "required",
            "category" => "required",
            "tags" => "array|required",
            "keyword" => "required",
            "meta_desc" => "required"
        ])->validate();

        $data = $request->all();

        $data['slug'] = Str::slug(request('title'));

        $data['category_id'] = request('category');

        $data['status'] = 'PUBLISH';

        $data['author_id'] = Auth::user()->id;

        $cover = $request->file('cover');

        if($cover){
        $cover_path = $cover->store('images/blog', 'public');

        $data['cover'] = $cover_path;
        }

        $post = Post::create($data);

        $post->tags()->attach(request('tags'));

        if ($post) {

                return redirect()->route('admin.post')->with('success', 'Post added successfully');

               } else {

                return redirect()->route('admin.post.create')->with('error', 'Post failed to add');

               }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::get();
        $tags = Tag::get();
        return view('admin.post.edit',compact('post','categories','tags'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            "title" => "required",
            "body" => "required",
            "category" => "required",
            "tags" => "array|required",
            "keyword" => "required",
            "meta_desc" => "required"
        ])->validate();

        $post = Post::findOrFail($id);

        $data = $request->all();

        $data['slug'] = Str::slug(request('title'));

        $data['category_id'] = request('category');

        $cover = $request->file('cover');

        if($cover){

            if($post->cover && file_exists(storage_path('app/public/' . $post->cover))){
                Storage::delete('public/'. $post->cover);
            }

        $cover_path = $cover->store('images/blog', 'public');

        $data['cover'] = $cover_path;
        }

        $update = $post->update($data);

        $post->tags()->sync(request('tags'));

        if ($update) {

                return redirect()->route('admin.post')->with('success', 'Data added successfully');

               } else {

                return redirect()->route('admin.post.create')->with('error', 'Data failed to add');

               }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('admin.post')->with('success','Post moved to trash');
    }

    public function trash(){
        $post = Post::onlyTrashed()->get();

        return view('admin.post.trash', compact('post'));
    }

    public function restore($id) {
        $post = Post::withTrashed()->findOrFail($id);

        if ($post->trashed()) {
            $post->restore();
            return redirect()->route('admin.post.trash')->with('success','Data successfully restored');
        }else {
            return redirect()->route('admin.post.trash')->with('error','Data is not in trash');
        }
    }

    public function deletePermanent($id){

        $post = Post::withTrashed()->findOrFail($id);

        if (!$post->trashed()) {

            return redirect()->route('admin.post.trash')->with('error','Data is not in trash');

        }else {

            $post->tags()->detach();


            if($post->cover && file_exists(storage_path('app/public/' . $post->cover))){
                Storage::delete('public/'. $post->cover);
            }

        $post->forceDelete();

        return redirect()->route('admin.post.trash')->with('success', 'Data deleted successfully');
        }
    }
}
