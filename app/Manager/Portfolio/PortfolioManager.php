<?php

namespace App\Manager\Portfolio;

use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use Illuminate\Http\Request;

class PortfolioManager
{
    private $portfolioRepository;
    public function __construct(PortfolioRepositoryInterface $portfolioRepository)
    {
        $this->portfolioRepository=$portfolioRepository;
    }
    public function index(){
        return $this->portfolioRepository->index();
    }

    public function create(){
        return $this->portfolioRepository->create();
    }

    public function store(Request $request){
        return $this->portfolioRepository->store($request);
    }

    public function show($id){
        return $this->portfolioRepository->show($id);
    }

    public function edit($id){
        return $this->portfolioRepository->edit($id);
    }

    public function update($id){
        return $this->portfolioRepository->update($id);
    }

    public function destroy($id){
        return $this->portfolioRepository->destroy($id);
    }
}
