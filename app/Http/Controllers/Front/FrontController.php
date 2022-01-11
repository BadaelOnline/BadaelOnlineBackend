<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\Front\FrontService;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    private $frontService;
    public function __construct(FrontService $frontService)
    {
        $this->frontService=$frontService;
    }
    public function home()
    {
        return $this->frontService->home();
    }

    public function about()
    {
        return $this->frontService->about();
    }

    public function team()
    {
        return $this->frontService->team();
    }

    public function testi()
    {
        return $this->frontService->testi();
    }
    public function service()
    {
        return $this->frontService->service();
    }

    public function serviceshow($slug)
    {
        return $this->frontService->serviceshow($slug);
    }

    public function portfolio()
    {
        return $this->frontService->portfolio();
    }

    public function portfolioshow($slug)
    {
        return $this->frontService->portfolioshow($slug);
    }

    public function blog()
    {
        return $this->frontService->blog();
    }

    public function blogshow($slug)
    {
        return $this->frontService->home($slug);
    }

    public function category()
    {
        return $this->frontService->category();
    }

    public function categoryshow($slug)
    {
        return $this->frontService->categoryshow($slug);
    }

    public function tag()
    {
        return $this->frontService->tag();
    }

    public function search()
    {
        return $this->frontService->search();
    }

    public function page()
    {
        return $this->frontService->page();
    }

    public function pageshow($slug)
    {
        return $this->frontService->pageshow($slug);
    }

    public function subscribe(Request $request)
    {
        return $this->frontService->subscribe($request);
    }

}
