<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
// use App\Service\User\UserService;
use App\Models\User\User;
// use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // private $userService;
    // public function __construct(UserService $userService)
    // {
    //     $this->userService=$userService;
    // }
    public function index()
    {
        $users = User::latest()->get();
        $users->transform(function($user){
            $user->role = $user->roles()->first();
            return $user;
        });
        return view('admin.user.index',[
            'user' => $users,
        ]);
        // return $this->userService->index();
    }

    public function create(){
        $roles = Role::all();
       return view ('admin.user.create',compact('roles'));
        // return $this->userService->create();
    }

    public function store(UserRequest $request){
        return 'ok';
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);

        // if ($user->save()) {
        //     return redirect()->route('admin.user')->with('success', 'Data added successfully');
        // }else {

        //     return redirect()->route('admin.user.create')->with('error', 'Data failed to add');

        //    }
        // return $this->userService->store($request);
    }

    public function show($id){
        // return $this->userService->show($id);
    }

    public function edit($id){
        // return $this->userService->edit($id);
        $user = User::findOrFail($id);
        return view('admin.user.edit',[
            'user' => $user
        ]);
    }

    public function update(UserRequest $request, $id){
        // return $this->userService->update($request, $id);
        try{
            // return $request->all();
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;

            return redirect()->route('admin.user')->with('success', 'Data updated successfully');
        }catch(\Exception $ex){
            return $ex->getMessage();
            return redirect()->route('admin.user.edit')->with('error', 'Data failed to update');
        }
    }

    public function changepassword(UserRequest $request, $id){
        // return $this->userService->changepassword($id,$request);
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);

        if ( $user->save()) {

            return redirect()->route('admin.user')->with('success', 'Password updated successfully');

           } else {

            return redirect()->route('admin.user')->with('error', 'Password failed to update');

           }
    }

    public function destroy($id){
        // return $this->userService->destroy($id);
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'Data deleted successfully');
    }
}
