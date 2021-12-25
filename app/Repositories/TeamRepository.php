<?php

namespace App\Repositories;

use App\Http\Requests\Team\TeamRequest;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Team\Team;
use App\Models\Team\TeamTranslation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('team-list',$this->user);

        return $this->team::orderBy('id','desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('team-create',$this->user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Gate::authorize('team-create',$this->user);

            /** transformation to collection */
            $allteams = collect($request->team)->all();

            $request->is_active ? $is_active = true : $is_active = false;

            $photo = $request->file('photo');
            if($photo){
            $cover_path = $photo->store('images/team', 'public');
            $photo = $cover_path;
            }

            DB::beginTransaction();
            // //create the default language's team
            $unTransTeam_id = $this->team->insertGetId([
                'facebook' => $request['facebook'],
                'twitter' => $request['twitter'],
                'instagram' => $request['instagram'],
                'linkedin' => $request['linkedin'],
                'is_active' => $request->is_active = 1,
                'photo' => $request->file('photo'),
            ]);

            //check the Team and request
            if (isset($allteams) && count($allteams)) {
                //insert other traslations for Teams
                foreach ($allteams as $allteam) {
                    $transTeam_arr[] = [
                        'name' => $allteam ['name'],
                        'local' => $allteam['local'],
                        'position' => $allteam['position'],
                        'qoute' => $allteam['qoute'],
                        'team_id' => $unTransTeam_id
                    ];
                }
                $this->teamTranslation->insert($transTeam_arr);
            }
            DB::commit();

            return redirect()->route('admin.team')->with('success', 'Data added successfully');

        } catch (\Exception $ex) {
            DB::rollback();
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
        return $this->team::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            Gate::authorize('team-update',$this->user);

            $team = $this->team::findOrFail($id);

            $photo = $request->file('photo');
            if($photo){
            $cover_path = $photo->store('images/team', 'public');
            $photo = $cover_path;
            }

            DB::beginTransaction();
            // //create the default language's team
            $unTransTeam_id = $this->team->where('teams.id', $id)
                ->update([
                'facebook' => $request['facebook'],
                'twitter' => $request['twitter'],
                'instagram' => $request['instagram'],
                'linkedin' => $request['linkedin'],
                'is_active' => $request->is_active = 1,
                'photo' => $request->file('photo'),
            ]);

            $allteams = array_values($request->team);
                //insert other traslations for Teams
                foreach ($allteams as $allteam) {
                    $this->teamTranslation->where('team_id', $id)
                    ->where('local', $allteam['local'])
                    ->update([
                        'name' => $allteam ['name'],
                        'local' => $allteam['local'],
                        'position' => $allteam['position'],
                        'qoute' => $allteam['qoute'],
                        'team_id' => $unTransTeam_id
                    ]);
                }
            DB::commit();
            return redirect()->route('admin.team')->with('success', 'Data updated successfully');
        }catch(\Exception $ex){
            DB::rollback();
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
