<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;

class ProfitrangeController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if(auth()->user()->role == 'administrator'){
            $profits = Players::selectRaw('sum(balance) as total_balance, sum(deposit) as total_deposit, date, coalesce(sum(balance)) - coalesce(sum(deposit)) as profit, sum(bonus) as total_bonus')->groupBy('date')->orderBy('date')->get()
            ->map(function($v){
                $reloadCount = Players::selectRaw('count(type) as reload_count')->where('date', $v->date)->where('type', 'reload')->first();
                $v->reload = $reloadCount->reload_count;

                $subCount = Players::selectRaw('count(type) as sub_count')->where('date', $v->date)->where('type', 'sub')->first();
                $v->sub = $subCount->sub_count;
                return $v;
            });
        }else{
            $profits = Players::selectRaw('sum(balance) as total_balance, sum(deposit) as total_deposit, date, coalesce(sum(balance)) - coalesce(sum(deposit)) as profit, sum(bonus) as total_bonus')
            ->leftJoin('workers', 'workers.id', '=', 'players.worker')
            ->where('workers.id', auth()->user()->id)
            ->groupBy('date')->orderBy('date')->get()
            ->map(function($v){
                $reloadCount = Players::selectRaw('count(type) as reload_count')->where('date', $v->date)->where('type', 'reload')->first();
                $v->reload = $reloadCount->reload_count;

                $subCount = Players::selectRaw('count(type) as sub_count')->where('date', $v->date)->where('type', 'sub')->first();
                $v->sub = $subCount->sub_count;
                return $v;
            });
        }
        
        // dd($profits);

        return view('profit.lists')->with([
            'profits' => $profits
        ]);
    }
}
