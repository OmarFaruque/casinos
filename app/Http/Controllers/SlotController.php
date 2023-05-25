<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use App\Http\Requests\SlotRequest;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slots = Slot::all();

        return view('slot.lists')->with([
            'slots' => $slots
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('slot.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SlotRequest $request)
    {
        $slot = new Slot;
        $slot->name     = $request->name;
        $slot->he       = $request->he;
        $slot->provider = $request->provider;
        $slot->save();

        return redirect('slot')->with('success','Updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slot $slot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slot $slot)
    {
        return view('slot.create')->with([
            'slot' => $slot
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlotRequest $request, Slot $slot)
    {
        $slot->name     = $request->name;
        $slot->he       = $request->he;
        $slot->provider = $request->provider;
        $slot->save();
        return redirect('slot')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slot $slot)
    {
        $slot->delete();
        return redirect('slot')->with('success','Updated successfully');
        
    }
}
