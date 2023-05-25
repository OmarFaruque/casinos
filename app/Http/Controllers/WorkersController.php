<?php

namespace App\Http\Controllers;

use App\Models\Workers;
use Illuminate\Http\Request;
use App\Http\Requests\WorkersRequest;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = Workers::all();

        return view('workers.lists')->with([
            'workers' => $workers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkersRequest $request)
    {
        $worker = new Workers;
        $worker->name = $request->name;
        $worker->save();

        return redirect('/workers/create')->with('success','Updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
