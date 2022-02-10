<?php

namespace App\Repositories;

use App\Http\Requests\User\UserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRepository implements UserRepositoryInterface{

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
    }

    public function create()
    {
        $roles = Role::all();
       return view ('admin.user.create',compact('roles'));
    }

    public function store(UserRequest $request)
    {

        try{
            return $request->all();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            return redirect()->route('admin.user')->with('success', 'Data added successfully');
        }catch(\Exception $ex){
            // DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.user.create')->with('error', 'Data failed to add');
        }
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);

        // if ($user->save()) {
        //     return redirect()->route('admin.user')->with('success', 'Data added successfully');
        // }else {

        //     return redirect()->route('admin.user.create')->with('error', 'Data failed to add');

        //    }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit',[
            'user' => $user
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ( $user->save()) {

            return redirect()->route('admin.user')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.user.edit')->with('error', 'Data failed to update');

           }
    }

    public function changepassword(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);

        if ( $user->save()) {

            return redirect()->route('admin.user')->with('success', 'Password updated successfully');

           } else {

            return redirect()->route('admin.user')->with('error', 'Password failed to update');

           }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'Data deleted successfully');
    }
}
