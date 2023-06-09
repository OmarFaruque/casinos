<?php

namespace App\Http\Controllers;

use App\Models\Players;
use App\Models\Workers;
use App\Models\Gnomeinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{


    public function ajax_getgnomesbyworkerid(Request $request){
        $gnomes = Gnomeinfo::where('worker', $request->worker_id)->get();
        return response()->json(['msg'=>'success', 'gnomes' => $gnomes]);
    }

     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!Auth::check())
            return view('home.index');
            
        $from = '';
        $to = '';
        $worker = '';
        $gnome = '';

        $datas = Players::selectRaw('SUM(case when (status <> "all-paid" AND status <> "dispute") then balance END) - sum(case when partpaid IS NOT NULL then partpaid END) as total_owed, 
        sum(bonus) as total_bonus,         
        coalesce(sum(balance)) - coalesce(sum(deposit)) as total_profit, 
        coalesce(sum(bonus) * 0.45) as bonus_ev,
        coalesce(sum(deposit)) as total_deposit,
        coalesce(sum(balance)) as total_balance,
        coalesce(sum(fainalpaid) + sum(partpaid)) as total_withdraws,
        coalesce(count(case when type = "sub" OR type="reload" then bonus END)) as bonus_done
        ');

        $charts = Players::selectRaw('date, coalesce(sum(balance)) - coalesce(sum(deposit)) as profit, coalesce(sum(bonus) * 0.45) as ev')->groupBy('date')->orderBy('date');

        if(isset($request->_token)){
            $from = isset($request->from) && !empty($request->from) ? $request->from : date('Y-m-d', strtotime('1970-01-01'));
            $to = isset($request->to) && !empty($request->to) ? $request->to : date('Y-m-d');
            $datas->whereBetween('date', [$from, $to]);
            $charts->whereBetween('date', [$from, $to]);

            if(!empty($request->worker)){
                $worker = $request->worker;
                $datas->where('worker', $request->worker);
                $charts->where('worker', $request->worker);
            }
            
            if(!empty($request->gnome)){
                $gnome = $request->gnome;
                $datas->where('name', $request->gnome);
                $charts->where('name', $request->gnome);
            }
        }

        $datas = $datas->first();
        $charts = $charts->get();

        $monthlyev = ($datas->whereRaw('DATE(date) >= DATE_SUB(CURDATE(), INTERVAL 8 DAY)')->sum('bonus') * 0.45) * 0.45;
      
        $sevens = Players::selectRaw(
            'coalesce(sum(bonus)) as bonus_value, 
            coalesce(count(case when type = "sub" OR type="reload" then bonus END)) as bonus_done,
            coalesce(sum(bonus) * 0.45) as bonus_ev,
            coalesce(sum(balance) - sum(deposit)) as bonus_profit,
            date'
        )->whereRaw('DATE(date) >= DATE_SUB(CURDATE(), INTERVAL 8 DAY)')
        ->groupBy('date')->get();

        


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
        
        $workers = Workers::select('id', 'name')->get();
        $gnomes = Gnomeinfo::select('id', 'name')->get();
        

        return view('overview.index')->with([
            'casino_dones' => $datas, 
            'sevens' => $sevens, 
            'groupreports' => $groupReports, 
            'charts' => $charts, 
            'monthly_ev' => $monthlyev, 
            'workers' => $workers, 
            'gnomes' => $gnomes, 
            'forms' => array(
                'to' => $to, 
                'from' => $from, 
                'worker' => $worker, 
                'gnome' => $gnome
            )
        ]);

        
    }
}
