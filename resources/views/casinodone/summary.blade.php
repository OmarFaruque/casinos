@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt w-full px-5 py-8">
        <a class="bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900" href="{{route('casinos-done')}}">{{ __('Casinodne Lists') }}</a>
        <div class="w-full m-auto mt-9">
            @if(session('success'))
                <div class="alert px-6 py-3 bg-blue-400 text-white mb-3 rounded">{{session('success')}}</div>
            @endif
            <div class="slotWrap w-5/6 mx-auto">
                <h2 class="mb-5 font-normal text-2xl">{{__('Statistics')}}</h2>
                <div class="body grid gap-6 grid-cols-3">
                    <div class="shadow flex rounded px-5 items-center py-6 justify-between bg-slate-100">
                        <h3><strong>{{__('Total Owed')}}</strong></h3>
                        <div><span>{{ $casino_dones->total_owed }}</span></div>
                    </div>
                    <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                        <h3><strong>{{__('Projected Monthly EV')}}</strong></h3>
                        <span>{{ 0 }}</span>
                    </div>
                    <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                        <h3><strong>{{__('Projected Monthly Bonuses')}}</strong></h3>
                        <span>{{ 0 }}</span>
                    </div>
                    <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                        <h3><strong>{{__('Part Payments')}}</strong></h3>
                        <span>{{ $casino_dones->total_partpaid }}</span>
                    </div>
                    <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                        <h3><strong>{{__('In Dispute')}}</strong></h3>
                        <span>{{ $casino_dones->total_deposit }}</span>
                    </div>
                    <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                        <h3><strong>{{__('Sign ups')}}</strong></h3>
                        <span>{{ $casino_dones->total_signups }}</span>
                    </div>
                    <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                        <h3><strong>{{__('Reloads')}}</strong></h3>
                        <span>{{ $casino_dones->total_reload }}</span>
                    </div>
                    <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                        <h3><strong>{{__('Bonus Value')}}</strong></h3>
                        <span>{{ $casino_dones->total_bonus }}</span>
                    </div>
                    <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                        <h3><strong>{{__('Profit')}}</strong></h3>
                        <span>{{ $casino_dones->total_profit }}</span>
                    </div>
                </div>

                <br>
                <h2 class="text-2xl mt-7 mb-2">{{__('Last '.count($sevens).' days')}}</h2>
                <div class="table w-full border rounded-md shadow-md">
                    <div class="table-header-group bg-slate-200">
                        <div class="table-row">
                            <div class="table-cell p-5"></div>
                            @foreach($sevens as $single) <div class="table-cell p-3">{{ date('d-M', strtotime($single->date)) }}</div>@endforeach
                            <div class="table-cell p-5"> {{__('Last '.count($sevens).' days')}}</div>
                        </div>
                    </div>
                    <div class="table-row-group">
                        <div class="table-row">
                            <div class="table-cell p-5">{{__('Bonus Value')}}</div>
                            @php $total_bonus_value = 0; @endphp
                            @foreach($sevens as $single)
                                <div class="table-cell p-3">{{ $single->bonus_value }}</div>
                                @php $total_bonus_value += $single->bonus_value; @endphp
                            @endforeach
                            <div class="table-cell p-5">{{$total_bonus_value}}</div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell p-5">{{__('Bonuses Done')}}</div>
                            @php $total_bonus_done = 0; @endphp
                            @foreach($sevens as $single)
                                <div class="table-cell p-3">{{ $single->bonus_done }}</div>
                                @php $total_bonus_done += $single->bonus_done; @endphp
                            @endforeach
                            <div class="table-cell p-5">{{$total_bonus_done}}</div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell p-5">{{__('EV')}}</div>
                            @php $total_bonus_ev = 0; @endphp
                            @foreach($sevens as $single) 
                                <div class="table-cell p-3">{{ $single->bonus_ev }}</div>
                                @php $total_bonus_ev += $single->bonus_ev; @endphp
                            @endforeach
                            <div class="table-cell p-5">{{$total_bonus_ev}}</div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell p-5">{{__('Profit')}}</div>
                            @php $total_profit = 0; @endphp
                            @foreach($sevens as $single) 
                                <div class="table-cell p-3">{{ $single->bonus_profit }}</div>
                                @php $total_profit += $single->bonus_profit; @endphp
                            @endforeach
                            <div class="table-cell p-5">{{$total_profit}}</div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection