<?php

namespace App\Manager\Service;

use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceManager
{
    private $serviceRepository;
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository=$serviceRepository;
    }
    public function index(){
        return $this->serviceRepository->index();
    }

    public function create(){
        return $this->serviceRepository->create();
    }

    public function store(Request $request){
        return $this->serviceRepository->store($request);
    }

    public function show($id){
        return $this->serviceRepository->show($id);
    }

    public function edit($id){
        return $this->serviceRepository->edit($id);
    }

    public function update(Request $request, $id){
        return $this->serviceRepository->update($id,$request);
    }

    public function destroy($id){
        return $this->serviceRepository->destroy($id);
    }
}