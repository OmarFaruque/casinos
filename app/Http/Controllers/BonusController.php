<?php

namespace App\Http\Controllers;

use App\Models\Bans;
use App\Models\Bonus;
use App\Models\Group;
use App\Models\Casino;
use App\Models\Players;
use App\Models\Workers;
use App\Models\Gnomeinfo;
use Illuminate\Http\Request;
use App\Http\Requests\BonusRequest;
use Illuminate\Support\Facades\Date;

class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role == 'administrator'){
            $bonuss = Bonus::select('bonuses.*', 'casinos.id as casino_id', 'groups.id as group_id', 'casinos.name as casino_name', 'groups.name as group_name')
                    ->leftJoin('casinos', 'casinos.id', '=', 'bonuses.casino_name')
                    ->leftJoin('groups', 'groups.id', '=', 'bonuses.group' )
                    ->get();
        }else{
            $worker = Workers::select('id')->where('assigned_user', auth()->user()->id)->first();
            $bonuss = Bonus::select('bonuses.*', 'casinos.id as casino_id', 'groups.id as group_id', 'casinos.name as casino_name', 'groups.name as group_name')
                    ->leftJoin('casinos', 'casinos.id', '=', 'bonuses.casino_name')
                    ->leftJoin('groups', 'groups.id', '=', 'bonuses.group' )
                    ->where('worker', $worker->id)
                    ->get();
        }

        $bonuss = $bonuss->map(function($v){
            $v->cando = 'No';
            $gnome_country_code = Gnomeinfo::where('id', $v->gnome)->get('code')->first();
            $v->country_banned = $v->country_banned ? json_decode($v->country_banned) : array();
            $v->payment_methods = $v->payment_methods ? json_decode($v->payment_methods) : array();

            $bans = Bans::where('gnome', $v->gnome)->where('casino', $v->casino_id)->get()->first(); //band gnome in casino
            $bansGroup = Bans::where('gnome', $v->gnome)->where('group', $v->group_id)->get()->first(); //band gnome in group


            // Okay to Play ? 
            $v->ok_to_play_country = 'yes';
            $v->ok_to_play_casino = 'yes';
            $v->ok_to_play_group = 'yes';

            if($gnome_country_code && is_array($v->country_banned) && in_array($gnome_country_code->code, $v->country_banned))
                $v->ok_to_play_country = 'no';
            
            if($bans) $v->ok_to_play_casino = 'no';
            if($bansGroup) $v->ok_to_play_group = 'no';
            
            
            


            $lasttimeGnomeDoneCasinoGroupDay = Players::selectRaw("datediff(now(), date) as day_diff")->where('name', $v->gnome)->where('group', $v->group)->where('type', 'sub')->orderByDesc('date')->limit(1)->first();
            $v->last_gnome_done_casino = $lasttimeGnomeDoneCasinoGroupDay ? $lasttimeGnomeDoneCasinoGroupDay->day_diff : 0;
            $v->gnome_done_casino_ok = 'yes';
            if($lasttimeGnomeDoneCasinoGroupDay && $lasttimeGnomeDoneCasinoGroupDay->day_diff < $v->gnome_done_casino){
                $v->gnome_done_casino_ok = 'no';
            }

            // Last time anyone done casino
            $lasttimeAnyoneDoneCasinoDay = Players::selectRaw("datediff(now(), date) as day_diff")->where('casino', $v->casino_id)->where('type', 'sub')->orderByDesc('date')->limit(1)->first();
            $v->last_anyone_done_casino = $lasttimeAnyoneDoneCasinoDay &&   $lasttimeAnyoneDoneCasinoDay->day_diff ? $lasttimeAnyoneDoneCasinoDay->day_diff : 0;
            $v->anyone_done_casino_ok = 'yes';
            if($lasttimeAnyoneDoneCasinoDay && $lasttimeAnyoneDoneCasinoDay->day_diff < $v->anyone_done_casino){
                $v->anyone_done_casino_ok = 'no';
            }
            

            // Last time anyone done group
            $lasttimeAnyoneDoneGroupDay = Players::selectRaw("datediff(now(), date) as day_diff")->where('group', $v->group)->where('type', 'sub')->orderByDesc('date')->limit(1)->first();
            $v->last_anyone_done_group = $lasttimeAnyoneDoneGroupDay && $lasttimeAnyoneDoneGroupDay->day_diff ? $lasttimeAnyoneDoneGroupDay->day_diff : 0;
            $v->anyone_done_group_ok = 'yes';
            if($lasttimeAnyoneDoneGroupDay && $lasttimeAnyoneDoneGroupDay->day_diff < $v->anyone_done_group){
                $v->anyone_done_group_ok = 'no';
            }

            // Pending Payouts for Gnome in this Group
            $pendingPayoutsForGnomeInGroup = Players::selectRaw('sum(`balance`) as pp_gnome_group')->where('name', $v->gnome)->where('group', $v->group)->where('status', 'pending-payout')->first();
            $v->pp_gnome_group = $pendingPayoutsForGnomeInGroup->pp_gnome_group;
            
            $v->pp_gnome_group_ok = 'yes';
            if($pendingPayoutsForGnomeInGroup && $pendingPayoutsForGnomeInGroup->pp_gnome_group && $v->gnome_pending_payout && $v->gnome_pending_payout < $v->pp_gnome_group){
                $v->pp_gnome_group_ok = 'no';
            }


            // Total Pending Payouts for Everyone for this Group
            $tPendingPayoutsForEveryoneInGroup = Players::selectRaw('sum(`balance`) as tpp_gnome_everyone_in_group')->where('group', $v->group)->where('status', 'pending-payout')->first();
            $v->tpp_gnome_everyone_in_group = $tPendingPayoutsForEveryoneInGroup->tpp_gnome_everyone_in_group;
            $v->tpp_gnome_everyone_in_group_ok = 'yes';
            if($tPendingPayoutsForEveryoneInGroup && $tPendingPayoutsForEveryoneInGroup->tpp_gnome_everyone_in_group && $v->everyone_pending_payout && $v->everyone_pending_payout < $v->tpp_gnome_everyone_in_group){
                $v->tpp_gnome_everyone_in_group_ok = 'no';
            }


            // SUB Pending Payouts for Everyone in this Group
            $sPendingPayoutsForEveryoneInGroup = Players::selectRaw('sum(`balance`) as spp_gnome_everyone_in_group')->where('group', $v->group)->where('status', 'pending-payout')->first();
            $v->spp_gnome_everyone_in_group = $sPendingPayoutsForEveryoneInGroup->spp_gnome_everyone_in_group;
            $v->spp_gnome_everyone_in_group_ok = 'yes';
            if($sPendingPayoutsForEveryoneInGroup && $sPendingPayoutsForEveryoneInGroup->spp_gnome_everyone_in_group && $v->everyone_sub_pending_payout && $v->everyone_sub_pending_payout < $v->spp_gnome_everyone_in_group){
                $v->spp_gnome_everyone_in_group_ok = 'no';
            }

            // dd($pendingPayoutsForGnomeInGroup);
            
            // Done 
            $v->done = 'no';
            $done = Players::selectRaw('count(*) as total')->where('name', $v->gnome)->where('casino_bonus_lookup', $v->id)->first();
            if($done && isset($done->total) && $done->total > 0)
                $v->done = 'yes';


            if($v->prtn != 0 
                && $v->ok_to_play_country == 'yes' 
                && $v->ok_to_play_casino == 'yes' 
                && $v->ok_to_play_group == 'yes' 
                && $v->gnome_done_casino_ok == 'yes' 
                && $v->anyone_done_casino_ok == 'yes'
                && $v->anyone_done_group_ok == 'yes'
                && $v->pp_gnome_group_ok == 'yes' 
                && $v->tpp_gnome_everyone_in_group_ok == 'yes' 
                && $v->spp_gnome_everyone_in_group_ok = 'yes' 
                && $v->done == 'no'
            ){
                $v->cando = 'Yes';
            }

            //Profit 
            $v->profit = $v->deposit && $v->bonus ? number_format(($v->bonus * 100 )  / $v->deposit, 2) . '%' : '';

            //Wagering total
            $v->wagering_total = $v->wagering_name == 'xdb' ? ($v->deposit + $v->bonus) * $v->wagering_value : $v->bonus * $v->wagering_value;

            
            return $v;
        });

        // dd($bonuss);

        return view('bonus.lists')->with([
            'bonuss' => $bonuss
        ]);
    }


    /**
     * Payment method lists 
     * 
     * @return array list of paymen method
     */
    protected function payment_method_lists(){
        return array(
            'btc' => 'BTC', 
            'luxon' => 'Luxon', 
            'ie' => 'IE', 
            'ca' => 'CA'
        );
    }


    /**
     * List of Bandable country lists
     * 
     * @return array
     */
    protected function bandable_country_lists(){
        return array(
            'NZ' => 'New Zealand', 
            'TH' => 'Thailand', 
            'NO' => 'Norway', 
            'AR' => 'Argentina'
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('bonus.create')->with([
            'gnomes' => Gnomeinfo::all(),
            'casinos' => Casino::all(), 
            'groups' => Group::all(), 
            'p_methods' => $this->payment_method_lists(), 
            'countries' => $this->bandable_country_lists()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BonusRequest $request)
    {
        $worker = Workers::select('id')->where('assigned_user', auth()->user()->id)->first();

        $bonus                              = new Bonus;
        $bonus->gnome                       = $request->gnome;
        // $bonus->casino_lookup               = $request->casino_lookup;
        $bonus->casino_name                 = $request->casino_name;
        $bonus->prtn                        = $request->prtn; 
        $bonus->group                       = $request->group;
        $bonus->deposit                     = $request->deposit; 
        $bonus->bonus                       = $request->bonus; 
        $bonus->wagering_name               = !empty($request->wagering_name) ? $request->wagering_name : '';
        $bonus->wagering_value              = $request->wagering_value;
        $bonus->payment_methods             = !empty($request->payment_methods) ? $request->payment_methods : ''; 
        $bonus->country_banned              = !empty($request->country_banned) ? $request->country_banned : '';
        $bonus->gnome_done_casino           = $request->gnome_done_casino;
        $bonus->anyone_done_casino          = $request->anyone_done_casino;
        $bonus->anyone_done_group           = $request->anyone_done_group;
        $bonus->gnome_pending_payout        = $request->gnome_pending_payout;
        $bonus->everyone_pending_payout     = $request->everyone_pending_payout;
        $bonus->everyone_sub_pending_payout = $request->everyone_sub_pending_payout;
        $bonus->notes                       = !empty($request->notes) ? $request->notes : '';
        $bonus->worker                      = $worker->id;

        // dd($bonus);

        $bonus->save();

        return redirect('bonus')->with('message', 'Bonus create successfully.');



    }

    /**
     * Display the specified resource.
     */
    public function show(Bonus $bonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($bonus)
    {
        $bonus = Bonus::find($bonus);
        $bonus->country_banned = json_decode($bonus->country_banned);
        
        return view('bonus.create')->with([
            'bonus' => $bonus,
            'gnomes' => Gnomeinfo::all(),
            'casinos' => Casino::all(), 
            'groups' => Group::all(), 
            'p_methods' => $this->payment_method_lists(), 
            'countries' => $this->bandable_country_lists()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BonusRequest $request, $bonus)
    {
        $bonus = Bonus::find($bonus);
        $bonus->gnome                       = $request->gnome;
        // $bonus->casino_lookup               = $request->casino_lookup;
        $bonus->casino_name                 = $request->casino_name;
        $bonus->prtn                        = $request->prtn; 
        $bonus->group                       = $request->group;
        $bonus->deposit                     = $request->deposit; 
        $bonus->bonus                       = $request->bonus; 
        $bonus->wagering_name               = !empty($request->wagering_name) ? $request->wagering_name : '';
        $bonus->wagering_value              = $request->wagering_value;
        $bonus->payment_methods             = !empty($request->payment_methods) ? $request->payment_methods : ''; 
        $bonus->country_banned              = !empty($request->country_banned) ? $request->country_banned : '';
        $bonus->gnome_done_casino           = $request->gnome_done_casino;
        $bonus->anyone_done_casino          = $request->anyone_done_casino;
        $bonus->anyone_done_group           = $request->anyone_done_group;
        $bonus->gnome_pending_payout        = $request->gnome_pending_payout;
        $bonus->everyone_pending_payout     = $request->everyone_pending_payout;
        $bonus->everyone_sub_pending_payout = $request->everyone_sub_pending_payout;
        $bonus->notes                       = !empty($request->notes) ? $request->notes : '';

        $bonus->save();

        return redirect('bonus')->with('message', 'Bonus Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bonus $bonus)
    {
        
    }
}
