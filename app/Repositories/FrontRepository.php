<?php

namespace App\Repositories;

use App\Scopes\AboutScope;
use App\Models\About\About;
use App\Models\Banner\Banner;
use App\Models\Category\Category;
use App\Models\Faq\Faq;
use App\Models\General\General;
use App\Models\Link\Link;
use App\Models\Page\Page;
use App\Models\Partner\Partner;
use App\Models\Pcategory\Pcategory;
use App\Models\Portfolio\Portfolio;
use App\Models\Post\Post;
use App\Models\Service\Service;
use App\Models\Subscriber;
use App\Models\Tag\Tag;
use App\Models\Team\Team;
use App\Models\Team\TeamTranslation;
use App\Models\Testimonial\Testimonial;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;

use App\Repositories\Interfaces\FrontRepositoryInterface;
use Illuminate\Http\Request;

class FrontRepository implements FrontRepositoryInterface{


    private $tag;
    private $category;
    private $team;
    private $TeamTranslation;
    private $about;
    private $banner;
    private $faq;
    private $general;
    private $link;
    private $page;
    private $partner;
    private $pcategories;
    private $portfolio;
    private $post;
    private $testimonial;
    private $service;
    private $subscriber;
    use GeneralTrait;

    public function __construct(Tag $tag,Category $category ,Team $team,TeamTranslation $teamTranslation, About $about, Banner $banner, Faq $faq, General $general, Link $link, Page $page, Partner $partner, Pcategory $pcategories, Portfolio $portfolio, Post $post, Testimonial $testimonial, Service $service, Subscriber $subscriber)
    {
        $this->team = $team;
        $this->teamTranslation = $teamTranslation;
        $this->tag = $tag;
        $this->category = $category;
        $this->about = $about;
        $this->banner = $banner;
        $this->faq = $faq;
        $this->general = $general;
        $this->link = $link;
        $this->page = $page;
        $this->partner = $partner;
        $this->pcategories = $pcategories;
        $this->portfolio = $portfolio;
        $this->post = $post;
        $this->testimonial = $testimonial;
        $this->service = $service;
        $this->subscriber = $subscriber;
    }
    public function home()
    {
        try {
            $about = $this->about::withoutGlobalScope(AboutScope::class)->about()->find(1);
            $banner = $this->banner->all();
            $general = $this->general->find(1);
            $link = $this->link->orderBy('name','asc')->get();
            $categories = $this->category->orderBy('name','asc')->get();
            $post = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->get();
            $pcategories = $this->pcategories->all();
            $portfolio = $this->portfolio->all();
            $team = $this->team->orderBy('id','asc')->get();
            $service = $this->service->orderBy('title','asc')->get();

            return $response = $this->returnData(compact('about','team','banner','general','link','categories','post','pcategories','portfolio','service'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function about()
    {
        try{
            $about = $this->about->find(1);
            $faq = $this->faq->all();
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $partner = $this->partner->orderBy('name','asc')->get();
            // $team = $this->team->orderBy('id','asc')->get();
         return $response = $this->returnData(compact('about','faq','partner'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function team(){
        try {

            $team = $this->team->orderBy('id','asc')->get();
            return $response = $this->returnData(compact('team'));

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function testi()
    {
        try{
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            // $testi = $this->testimonial->orderBy('name','asc')->paginate(6);
            $testi = $this->testimonial->orderBy('name','asc')->get();
            return $response = $this->returnData(compact('testi'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function service()
    {
        try{
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $service = $this->service->orderBy('title','asc')->get();
            return $response = $this->returnData(compact('service'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function serviceshow($slug)
    {
        try{
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $service = $this->service->where('slug', $slug)->firstOrFail();
            return $response = $this->returnData(compact('service'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function portfolio()
    {
        try{
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $pcategories = $this->pcategories->all();
            $portfolio = $this->portfolio->all();
            return $response = $this->returnData(compact('portfolio','pcategories'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function portfolioshow($slug)
    {
        try{
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $portfolio = $this->portfolio->where('slug', $slug)->firstOrFail();
            return $response = $this->returnData(compact('portfolio'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function blog()
    {
        try{
            $categories = $this->category->all();
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            $post = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            // $posts = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->paginate(3);
            $recent = $this->post->orderBy('id','desc')->limit(5)->get();
            $tags = $this->tag->all();
        return $response = $this->returnData(compact('categories','post','recent','tags'));

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function blogshow($slug)
    {
        try{
            // $categories = $this->category->all();
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $post = $this->post->where('slug', $slug)->firstOrFail();
            $old = $post->views;
            $new = $old + 1;
            $post->views = $new;
            $post->update();
            $recent = $this->post->orderBy('id','desc')->limit(5)->get();
            // $tags = $this->tag->get();
            return $response = $this->returnData(compact('post','recent'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function category()
    {
        try{
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            // $posts = $this->category->posts()->latest()->paginate(6);
            // $recent = $this->post->orderBy('id','desc')->limit(5)->get();
            // $tags = $this->tag->all();
            $categories = $this->category->all();
            return $response = $this->returnData(compact('categories'));
        } catch (\Exception $ex) {
         return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function categoryshow($slug)
    {
        try{
            $categories = $this->category->where('slug', $slug)->firstOrFail();
            return $response = $this->returnData(compact('categories'));
        } catch (\Exception $ex) {
         return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function tag()
    {
        try{
            // $categories = $this->category->all();
            // $general = $this->general->find(1);
            // $link = $this->link->orderBy('name','asc')->get();
            // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            // $posts = $this->tag->posts()->latest()->paginate(12);
            // $recent = $this->post->orderBy('id','desc')->limit(5)->get();
            $tags = $this->tag->all();
        return $response = $this->returnData(compact('tags'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function search()
    {
        try{
         $query = request("query");
         // $categories = $this->category->all();
         // $general = $this->general->find(1);
          // $link = $this->link->orderBy('name','asc')->get();
          // $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
          $posts = $this->post->where("title","like","%$query%")->latest()->paginate(9);
           // $recent = $this->post->orderBy('id','desc')->limit(5)->get();
           // $tags = $this->tag->all();
           return $response = $this->returnData(compact('posts','query'));
     } catch (\Exception $ex) {
         return $this->returnError($ex->getCode(), $ex->getMessage());
     }
    }

    public function page()
    {
        try{
            // $general = $this->general::find(1);
            // $link = $this->link::orderBy('name','asc')->get();
            // $lpost = $this->post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $page = $this->page->all();
        return $response = $this->returnData(compact('page'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function pageshow($slug)
    {
        try{
            // $general = $this->general::find(1);
            // $link = $this->link::orderBy('name','asc')->get();
            // $lpost = $this->post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $page = $this->page->where('slug', $slug)->firstOrFail();
        return $response = $this->returnData(compact('page'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function subscribe(Request $request)
    {
        try{
            Validator::make($request->all(), [
                "email" => "required|unique:subscribers,email",
            ])->validate();

            $subs = new Subscriber();
            $subs->email = $request->email;
            if ( $subs->save()) {

                return redirect()->route('homepage')->with('success', 'You have successfully subscribed');

               } else {

                return redirect()->back();

               }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
