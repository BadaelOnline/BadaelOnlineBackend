<?php

namespace App\Service\Faq;

use App\Manager\Faq\FaqManager;
use Illuminate\Http\Request;

class FaqService
{
    private $faqManager;
    public function __construct(FaqManager $faqManager)
    {
        $this->faqManager = $faqManager;
    }
    public function index(){
        return $this->faqManager->index();
    }

    public function create(){
        return $this->faqManager->create();
    }

    public function store(Request $request){
        return $this->faqManager->store($request);
    }

    public function show($id){
        return $this->faqManager->show($id);
    }

    public function edit($id){
        return $this->faqManager->edit($id);
    }

    public function update($id){
        return $this->faqManager->update($id);
    }

    public function destroy($id){
        return $this->faqManager->destroy($id);
    }
}
