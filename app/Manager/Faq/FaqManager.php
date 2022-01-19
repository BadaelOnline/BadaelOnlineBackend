<?php

namespace App\Manager\Faq;

use App\Repositories\Interfaces\FaqRepositoryInterface;
use Illuminate\Http\Request;

class FaqManager
{
    private $faqRepository;
    public function __construct(FaqRepositoryInterface $faqRepository)
    {
        $this->faqRepository=$faqRepository;
    }
    public function index(){
        return $this->faqRepository->index();
    }

    public function create(){
        return $this->faqRepository->create();
    }

    public function store(Request $request){
        return $this->faqRepository->store($request);
    }

    public function show($id){
        return $this->faqRepository->show($id);
    }

    public function edit($id){
        return $this->faqRepository->edit($id);
    }

    public function update($id){
        return $this->faqRepository->update($id);
    }

    public function destroy($id){
        return $this->faqRepository->destroy($id);
    }
}
