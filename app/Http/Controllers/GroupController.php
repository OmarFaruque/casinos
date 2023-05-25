<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequests;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('groups.lists')->with([
            'groups' => Group::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create');
    }


    
    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequests $request)
    {
        $group = new Group;
        $group->name = $request->name; 
        $group->save();

        return redirect('groups')->with('success','Group create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view('groups.create')->with([
            'group' => $group
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequests $request, Group $group)
    {
        $group->name = $request->name; 
        $group->save();

        return redirect('groups')->with('success','Updated successfully');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect('groups')->with('success','Group delete successfully');
    }
}
