<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Casino;
use Illuminate\Http\Request;
use App\Http\Requests\CasinoRequest;

class CasinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casinos = Casino::all()->map(function( $v ){
            $v->group_name = '';
            $groupname = Group::select('name')->where('id', $v->group_id)->first();
            if($groupname)
                $v->group_name = $groupname->name;
            
            return $v;

        });

        
        // dd($casinos);
        return view('casino.lists')->with([
            'casinos' => $casinos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('casino.create')->with([
            'groups' => Group::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CasinoRequest $request)
    {
        $casino = new Casino;
        $casino->name = $request->name; 
        $casino->group_id = $request->group_id; 
        $casino->save(); 
        
        return redirect('casinos')->with('message', 'Casino create successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Casino $casino)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Casino $casino)
    {
        return view('casino.create')->with([
            'casino' => $casino,
            'groups' => Group::select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CasinoRequest $request, Casino $casino)
    {
        $casino->name = $request->name; 
        $casino->group_id = $request->group_id; 
        $casino->save();

        return redirect('casinos')->with('success','Updated successfully');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Casino $casino)
    {
        $casino->delete();
        return redirect('casinos')->with('success','Delete casino successfully');
    }
}
