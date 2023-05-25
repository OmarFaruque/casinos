<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Bonus;
use App\Models\Group;
use App\Models\Casino;
use App\Models\Players;
use App\Models\Workers;
use App\Models\Gnomeinfo;
use Illuminate\Http\Request;
use App\Http\Requests\PlayersRequests;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCasinosDones = Players::select('players.*', 'gnomeinfos.name as name', 'groups.name as group', 'casinos.name as casino_name', 'bonuses.casino_lookup as bonus_lookup_casino_name')
        ->leftJoin('gnomeinfos', 'gnomeinfos.id', '=', 'players.name')
        ->leftJoin('groups', 'groups.id', '=', 'players.group')
        ->leftJoin('casinos', 'casinos.id', '=', 'players.casino')
        ->leftJoin('bonuses', 'bonuses.id', '=', 'players.casino_bonus_lookup')
        ->get(); 

        //dd($allCasinosDones);
        
        return view('casinodone.lists')->with([
            'casino_dones' => $allCasinosDones
        ]);
    }



    /**
     * List of all available payment methods
     * 
     * @return array
     */
    protected function Payment_methods(){
        return array(
            'btc' => 'btc', 
            'icard' => 'icard', 
            'visa' => 'visa', 
            'astro' => 'astro', 
            'flex' => 'flex', 
            'mb' => 'mb', 
            'cashlib' => 'cashlib', 
            'jeton' => 'jeton'
        );
    }


    /**
     * Status Lists
     */
    protected function status_lists(){
        return array(
            'all-paid' => __('All Paid'), 
            'running'=> __('Running'), 
            'to-do' => __('To Do'), 
            'lost' => __('Lost'), 
            'pending-payout' => __('Pending Payout'), 
            'failed' => __('Failed'), 
            'running-liz' => __('Running - Liz'), 
            'running-toby' => __('Running - Toby')
        );
    }

    
    /**
     * Get All Workers
     */
    protected function all_workers(){
        return Workers::all();
    }

    /**
     * Get All Slots
     */
    protected function all_slots(){
        return Slot::get(['id', 'name']);
    }


    /**
     * Get all types
     * 
     * @return array
     */
    protected function all_types(){
        return array(
            'sub' => 'SUB', 
            'reload' => 'Reload', 
            'cb' => 'CB'
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('casinodone.create')->with([
            'status_lists' => $this->status_lists(), 
            'workers' => $this->all_workers(), 
            'slots' => $this->all_slots(), 
            'payment_methods' => $this->Payment_methods(), 
            'types' => $this->all_types(), 
            'bonuses' => Bonus::select('id', 'casino_lookup')->get(), 
            'groups' => Group::select('id', 'name')->get(), 
            'casinos' => Casino::select('id', 'name')->get(), 
            'gnomes' => Gnomeinfo::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayersRequests $request)
    {
        $casinoDone = new Players;

        $casinoDone->name                   = $request->name;
        $casinoDone->date                   = $request->date;
        $casinoDone->casino_bonus_lookup    = $request->casino_bonus_lookup;
        $casinoDone->type                   = $request->type;
        $casinoDone->casino                 = $request->casino;
        $casinoDone->group                  = !empty($request->group) ? $request->group : '';
        $casinoDone->payment_method         = !empty($request->payment_method) ? $request->payment_method : '';
        $casinoDone->deposit                = !empty($request->deposit) ? $request->deposit : 0;
        $casinoDone->bonus                  = !empty($request->bonus) ? $request->bonus :0;
        $casinoDone->balance                = !empty($request->balance) ? $request->balance : 0;
        $casinoDone->status                 = $request->status;
        $casinoDone->partpaid               = $request->partpaid;
        $casinoDone->fainalpaid             = $request->fainalpaid;
        $casinoDone->game_played            = $request->game_played;
        $casinoDone->spin                   = $request->spin;
        $casinoDone->rtp                    = $request->rtp;
        $casinoDone->worker                 = $request->worker;
        $casinoDone->notes                  = !empty($request->notes) ? $request->notes : '';

        $casinoDone->save();

        return redirect('casinos-done')->with('message', 'Casidone create successfully.');
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
        return view('casinodone.create')->with([
            'status_lists' => $this->status_lists(), 
            'workers' => $this->all_workers(), 
            'slots' => $this->all_slots(), 
            'payment_methods' => $this->Payment_methods(), 
            'types' => $this->all_types(), 
            'bonuses' => Bonus::select('id', 'casino_lookup')->get(), 
            'groups' => Group::select('id', 'name')->get(), 
            'casinos' => Casino::select('id', 'name')->get(), 
            'done' => Players::find($id),
            'gnomes' => Gnomeinfo::select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlayersRequests $request, string $id)
    {
        $casinoDone = Players::find($id);
        $casinoDone->name                   = $request->name;
        $casinoDone->date                   = $request->date;
        $casinoDone->casino_bonus_lookup    = $request->casino_bonus_lookup;
        $casinoDone->type                   = $request->type;
        $casinoDone->casino                 = $request->casino;
        $casinoDone->group                  = !empty($request->group) ? $request->group : '';
        $casinoDone->payment_method         = !empty($request->payment_method) ? $request->payment_method : '';
        $casinoDone->deposit                = !empty($request->deposit) ? $request->deposit : 0;
        $casinoDone->bonus                  = !empty($request->bonus) ? $request->bonus :0;
        $casinoDone->balance                = !empty($request->balance) ? $request->balance : 0;
        $casinoDone->status                 = $request->status;
        $casinoDone->partpaid               = $request->partpaid;
        $casinoDone->fainalpaid             = $request->fainalpaid;
        $casinoDone->game_played            = $request->game_played;
        $casinoDone->spin                   = $request->spin;
        $casinoDone->rtp                    = $request->rtp;
        $casinoDone->worker                 = $request->worker;
        $casinoDone->notes                  = !empty($request->notes) ? $request->notes : '';

        $casinoDone->save();

        return redirect('casinos-done')->with('message', 'Casidone update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
