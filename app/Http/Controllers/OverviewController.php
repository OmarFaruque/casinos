<?php

namespace App\Http\Controllers;

use App\Models\Players;
use App\Models\Workers;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(isset($request->from)){
            $to = isset($request->to) && !empty($request->to) ? $request->to : date('Y-m-d');
            $datas = Players::selectRaw('SUM(case when (status <> "all-paid" AND status <> "dispute") then balance END) - sum(case when partpaid IS NOT NULL then partpaid END) as total_owed, 
            sum(bonus) as total_bonus,         
            coalesce(sum(balance)) - coalesce(sum(deposit)) as total_profit, 
            coalesce(sum(bonus) * 0.45) as bonus_ev,
            coalesce(count(case when type = "sub" OR type="reload" then bonus END)) as bonus_done
            ')->whereBetween('date', [$request->from, $to])->first();
        }else{
            $datas = Players::selectRaw('SUM(case when (status <> "all-paid" AND status <> "dispute") then balance END) - sum(case when partpaid IS NOT NULL then partpaid END) as total_owed, 
            sum(bonus) as total_bonus,         
            coalesce(sum(balance)) - coalesce(sum(deposit)) as total_profit, 
            coalesce(sum(bonus) * 0.45) as bonus_ev,
            coalesce(count(case when type = "sub" OR type="reload" then bonus END)) as bonus_done
            ')->first();
        }
        
     
        $monthlyev = ($datas->whereRaw('DATE(date) >= DATE_SUB(CURDATE(), INTERVAL 8 DAY)')->sum('bonus') * 0.45) * 0.45;
      
        $sevens = Players::selectRaw(
            'coalesce(sum(bonus)) as bonus_value, 
            coalesce(count(case when type = "sub" OR type="reload" then bonus END)) as bonus_done,
            coalesce(sum(bonus) * 0.45) as bonus_ev,
            coalesce(sum(balance) - sum(deposit)) as bonus_profit,
            date'
        )->whereRaw('DATE(date) >= DATE_SUB(CURDATE(), INTERVAL 8 DAY)')
        ->groupBy('date')->get();

        $charts = Players::selectRaw('date, coalesce(sum(balance)) - coalesce(sum(deposit)) as profit, coalesce(sum(bonus) * 0.45) as ev')->groupBy('date')->orderBy('date')->get();


        $groupReports = Workers::select('id', 'name')->get()
        ->map(function($v){
            // echo 'idis: ' . $v->id . '<br/>';
            $totalOwd = Players::selectRaw('SUM(case when (status <> "all-paid" AND status <> "dispute") then balance END) - sum(case when partpaid IS NOT NULL then partpaid END) as total_owed')->where('worker', $v->id)->first();
            $v->total_owed = $totalOwd->total_owed;
            $reports = Players::selectRaw(
                'coalesce(sum(bonus)) as bonus_value, 
                coalesce(count(case when type = "sub" OR type="reload" then bonus END)) as bonus_done,
                coalesce(sum(bonus) * 0.45) as bonus_ev,
                coalesce(sum(balance) - sum(deposit)) as bonus_profit,
                date'
            )->where('worker', $v->id)->whereRaw('DATE(date) >= DATE_SUB(CURDATE(), INTERVAL 8 DAY)')->groupBy('date')->get();
            $v->reports = $reports;
            return $v;
        });
        
        // dd($groupReports);    

        return view('overview.index')->with([
            'casino_dones' => $datas, 
            'sevens' => $sevens, 
            'groupreports' => $groupReports, 
            'charts' => $charts, 
            'monthly_ev' => $monthlyev
        ]);

        
    }
}
