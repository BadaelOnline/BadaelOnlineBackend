<?php

namespace App\Repositories;

use App\Events\PostEvent;
use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\Post\PostTranslation;
use App\Models\Tag\Tag;
use App\Models\User\User;
use App\Notifications\AddPostNotification;
use App\Notifications\PostNotification;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface{

    private $post;
    private $postTranslation;
    private $category;
    private $tag;
    public function __construct(Post $post , PostTranslation $postTranslation , Category $category , Tag $tag)
    {
        $this->post = $post;
        $this->postTranslation = $postTranslation;
        $this->category = $category;
        $this->tag = $tag;
    }

    public function index()
    {
        $post = $this->post::orderBy('id','desc')->get();

        return view('admin.post.index',compact('post'));
    }

    public function create()
    {

        $categories = $this->category::get();
        $tags = $this->tag::get();

        return view('admin.post.create',compact('categories','tags'));
    }

    public function store(Request $request)
    {

        try {
            return $request->all();
            // /** transformation to collection */
            $allposts = collect($request->post)->all();

            $request->is_active ? $is_active = true : $is_active = false;

            DB::beginTransaction();
            //create the default language's post
            $unTransPost_id = $this->post->insertGetId([
                'category_id' => $request['category'],
                'author_id' => Auth::user()->id,
                'slug' => $request->slug = 'title',
                'cover' => $request['cover'],
                'is_active' => $request->is_active = 1,
                'status' => 'PUBLISH'
            ]);

            // $cover = $request->file('cover');
            // if($cover){
            // $cover_path = $cover->store('images/blog', 'public');
            // $cover = $cover_path;
            // }

            $cover = $request->file('cover');
            if($cover){
            $cover_path = $cover->store('images/blog', 'public');
            $cover = $cover_path;
            }

            //check the Post and request
            if (isset($allposts) && count($allposts)) {
                //insert other traslations for Posts
                foreach ($allposts as $allpost) {
                    $transPost_arr[] = [
                        'title' => $allpost ['title'],
                        'local' => $allpost['local'],
                        'body' => $allpost['body'],
                        'keyword' => $allpost['keyword'],
                        'meta_desc' => $allpost['meta_desc'],
                        'post_id' => $unTransPost_id
                    ];
                }
                $this->postTranslation->insert($transPost_arr);
            }
             DB::commit();

            $notification=Post::find($unTransPost_id);
            event(new PostEvent($notification));

            return redirect()->route('admin.post')->with('success', 'Data added successfully');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            DB::rollback();
            return redirect()->route('admin.post.create')->with('error', 'Data failed to add');
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

    public function MarkNotification(){
        foreach(auth()->user()->unreadNotifications as $notification){
            $notification->markAsRead();
        }
    }
}
