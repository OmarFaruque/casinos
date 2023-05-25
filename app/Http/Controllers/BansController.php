<?php

namespace App\Http\Controllers;

use App\Models\Bans;
use App\Models\Group;
use App\Models\Casino;
use App\Models\Gnomeinfo;
use Illuminate\Http\Request;
use App\Http\Requests\BansRequests;

class BansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bans = Bans::select('bans.id', 'gnomeinfos.name as gnome', 'casinos.name as casino', 'groups.name as group')
                ->leftJoin('gnomeinfos', 'gnomeinfos.id', '=', 'bans.gnome')
                ->leftJoin('casinos', 'casinos.id', '=', 'bans.casino')
                ->leftJoin('groups', 'groups.id', '=', 'bans.group')
                ->get();
        
        return view('bans.lists')->with([
            'bans' => $bans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bans.create')->with([
            'gnomes' => Gnomeinfo::all(),
            'casinos' => Casino::all(), 
            'groups' => Group::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BansRequests $request)
    {
        $bans = new Bans;
        $bans->gnome = $request->gnome;
        $bans->casino = $request->casino;
        $bans->group = $request->group;
        $bans->save();

        return redirect('bans')->with('message', 'Bans create successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bans $bans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($bans)
    {
        $bans = Bans::find($bans);
        return view('bans.create')->with([
            'bans' => $bans,
            'gnomes' => Gnomeinfo::all(),
            'casinos' => Casino::all(), 
            'groups' => Group::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BansRequests $request, $bans)
    {
        $bans = Bans::find($bans);
        $bans->gnome = $request->gnome;
        $bans->casino = $request->casino;
        $bans->group = $request->group;
        $bans->save();

        return redirect('bans')->with('message', 'Bans update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bans)
    {
        $bans = Bans::find($bans);
        $bans->delete();
        return redirect('bans')->with('success','Delete bans successfully');
    }
}
