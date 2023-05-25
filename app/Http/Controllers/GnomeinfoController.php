<?php

namespace App\Http\Controllers;

use App\Models\Workers;
use App\Models\Gnomeinfo;
use App\Http\Requests\StoreGnomeinfoRequest;
use App\Http\Requests\UpdateGnomeinfoRequest;

class GnomeinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gnomes = Gnomeinfo::select('gnomeinfos.*', 'gnomeinfos.name as gnome_name', 'workers.name as worker_name')->leftJoin('workers', 'workers.id', '=', 'gnomeinfos.worker')->get();
        
        return view('gnomeinfo.lists')->with([
            'gnomes' => $gnomes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gnomeinfo.create')->with([
            'workers' => Workers::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGnomeinfoRequest $request)
    {
        $gnomeinfo = new Gnomeinfo;
        $gnomeinfo->name = $request->name;
        $gnomeinfo->country = $request->country;
        $gnomeinfo->code = $request->code;
        $gnomeinfo->worker = $request->worker;
        $gnomeinfo->email = $request->email;

        $gnomeinfo->save();

        return redirect('gnomeinfo')->with('success', 'New gnome create succefully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gnomeinfo $gnomeinfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gnomeinfo $gnomeinfo)
    {
        return view('gnomeinfo.create')->with([
            'gnome' => $gnomeinfo, 
            'workers' => Workers::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGnomeinfoRequest $request, Gnomeinfo $gnomeinfo)
    {
        $gnomeinfo->name        = $request->name;
        $gnomeinfo->country     = $request->country;
        $gnomeinfo->code        = $request->code;
        $gnomeinfo->email       = $request->email;
        $gnomeinfo->worker      = $request->worker;
        $gnomeinfo->save();
        return redirect('gnomeinfo')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gnomeinfo $gnomeinfo)
    {
        $gnomeinfo->delete();
        return redirect('gnomeinfo')->with('success','Updated successfully');
    }
}
