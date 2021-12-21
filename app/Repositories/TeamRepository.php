<?php

namespace App\Repositories;

use App\Http\Requests\Team\TeamRequest;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Team\Team;
use App\Models\Team\TeamTranslation;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class TeamRepository implements TeamRepositoryInterface{

    private $team;
    private $teamTranslation;
    private $user;
    public function __construct(User $user, Team $team , TeamTranslation $teamTranslation)
    {
        $this->user = $user;
        $this->team = $team;
        $this->teamTranslation = $teamTranslation;

    //     $this->middleware('can:team-list')->only('index','show');
    //     $this->middleware('can:team-create')->only('create','store');
    //     $this->middleware('can:team-update')->only('edit','update');
    //     $this->middleware('can:team-delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('team-list',$this->user);
        $team = $this->team::orderBy('id','desc')->get();

        return view('admin.team.index',compact('team'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('team-create',$this->user);
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        Gate::authorize('team-create',$this->user);
        $team = new Team();
        $team->name = $request->name;
        $team->position = $request->position;
        $team->twitter = $request->twitter;
        $team->facebook = $request->facebook;
        $team->instagram = $request->instagram;
        $team->linkedin = $request->linkedin;
        $team->qoute = $request->qoute;

        $photo = $request->file('photo');

        if($photo){
        $cover_path = $photo->store('images/team', 'public');

        $team->photo = $cover_path;
        }

        if ( $team->save()) {

            return redirect()->route('admin.team')->with('success', 'Data added successfully');

           } else {

            return redirect()->route('admin.team.create')->with('error', 'Data failed to add');

           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('team-list',$this->user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('team-update',$this->user);
        $team = $this->team::findOrFail($id);

        return view('admin.team.edit',compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {
        Gate::authorize('team-update',$this->user);
        $team = $this->team::findOrFail($id);
        $team->name = $request->name;
        $team->position = $request->position;
        $team->twitter = $request->twitter;
        $team->facebook = $request->facebook;
        $team->instagram = $request->instagram;
        $team->linkedin = $request->linkedin;
        $team->qoute = $request->qoute;

        $new_photo = $request->file('photo');

        if($new_photo){
        if($team->photo && file_exists(storage_path('app/public/' . $team->photo))){
            Storage::delete('public/'. $team->photo);
        }

        $new_cover_path = $new_photo->store('images/team', 'public');

        $team->photo = $new_cover_path;
        }

        if ( $team->save()) {

            return redirect()->route('admin.team')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.team.edit')->with('error', 'Data failed to update');

           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('team-delete',$this->user);
        $team = $this->team::findOrFail($id);

        $team->delete();

        return redirect()->route('admin.team')->with('success', 'Data deleted successfully');


    }
}
