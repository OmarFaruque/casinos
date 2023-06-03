<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() 
    {
        if(!Auth::check())
            return view('home.index');

        if( auth()->user()->role == 'administrator'){
            $profits = Players::selectRaw('date, coalesce(sum(balance)) - coalesce(sum(deposit)) as profit, coalesce(sum(bonus) * 0.45) as ev')->groupBy('date')->orderBy('date')->get();
        }else{
            $profits = Players::selectRaw('players.date, coalesce(sum(balance)) - coalesce(sum(deposit)) as profit, coalesce(sum(bonus) * 0.45) as ev')
            ->leftJoin('workers', 'workers.id', '=', 'players.worker')
            ->where('workers.id', auth()->user()->id)
            ->groupBy('players.date')->orderBy('players.date')->get();
        }
        
        return view('home.index')->with([
            'profits' => $profits
        ]);
    }
}
