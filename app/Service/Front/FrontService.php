<?php

namespace App\Service\Front;

use App\Manager\Front\FrontManager;
use Illuminate\Http\Request;

class FrontService
{
    private $frontManager;
    public function __construct(FrontManager $frontManager)
    {
        $this->frontManager=$frontManager;
    }
    public function home()
    {
        return $this->frontManager->home();
    }

    public function about()
    {
        return $this->frontManager->about();
    }

    public function team()
    {
        return $this->frontManager->team();
    }

    public function testi()
    {
        return $this->frontManager->testi();
    }
    public function service()
    {
        return $this->frontManager->service();
    }

    public function serviceshow($slug)
    {
        return $this->frontManager->serviceshow($slug);
    }

    public function portfolio()
    {
        return $this->frontManager->portfolio();
    }

    public function portfolioshow($slug)
    {
        return $this->frontManager->portfolioshow($slug);
    }

    public function blog()
    {
        return $this->frontManager->blog();
    }

    public function blogshow($slug)
    {
        return $this->frontManager->blogshow($slug);
    }

    public function category()
    {
        return $this->frontManager->category();
    }

    public function categoryshow($slug)
    {
        return $this->frontManager->categoryshow($slug);
    }

    public function tag()
    {
        return $this->frontManager->tag();
    }

    public function search()
    {
        return $this->frontManager->search();
    }

    public function page()
    {
        return $this->frontManager->page();
    }

    public function pageshow($slug)
    {
        return $this->frontManager->pageshow($slug);
    }

    public function subscribe(Request $request)
    {
        return $this->frontManager->subscribe($request);
    }
}
