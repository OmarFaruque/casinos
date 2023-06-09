<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Players;
use App\Models\Workers;
use App\Models\Gnomeinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\WorkersRequest;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = Workers::select('workers.*', 'users.display_name as display_name', 'users.name as user_name')
        ->leftJoin('users', 'users.id', '=', 'workers.assigned_user')
        ->get()
        ->map(function($v){
            $totalUserProfit = Players::selectRaw('(SUM(case when status <> "all-paid" AND status <> "dispute" then balance END)  - sum(case when partpaid IS NOT NULL then partpaid END)) as total_owed')->where('worker', $v->id)->first();
            $allGnoms = Gnomeinfo::selectRaw('group_concat(name SEPARATOR ", ") as names')->where('worker', $v->id)->first();
            $v->gnomes = $allGnoms->names;
            $v->owed = $totalUserProfit->total_owed;
            return $v;
        });

        return view('workers.lists')->with([
            'workers' => $workers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'display_name', 'name', 'email')->get();
        return view('workers.create')->with([
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkersRequest $request)
    {
        $worker = new Workers;
        $worker->name = $request->name;
        $worker->wallet_id = $request->wallet_id;
        $worker->assigned_user = $request->assigned_user;
        $worker->save();

        return redirect('workers')->with('success','Assigned user as worker successfully.');
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
        $worker = Workers::find($id);
        $users = User::select('id', 'display_name', 'name')->get();
        return view('workers.create')->with([
            'worker' => $worker, 
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkersRequest $request, string $id)
    {
        $worker = Workers::find($id);
        $worker->name = $request->name;
        $worker->wallet_id = $request->wallet_id;
        $worker->assigned_user = $request->assigned_user;

        $worker->save();

        return redirect('workers')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $worker = Workers::find($id);
        $worker->delete();
        return redirect('workers')->with('success','Delete casino successfully');
    }
}
