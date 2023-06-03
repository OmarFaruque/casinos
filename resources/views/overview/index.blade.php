@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt w-full px-5 py-8">
        <div class="w-full m-auto mt-9">
            @if(session('success'))
                <div class="alert px-6 py-3 bg-blue-400 text-white mb-3 rounded">{{session('success')}}</div>
            @endif
            <div class="slotWrap w-full mx-auto">
                <div class="grid grid-cols-2 gap-10">
                    <div class="">
                        <h2 class="mb-5 font-normal text-2xl">{{__('Statistics')}}</h2>
                        <form action="{{route('overview.index')}}" method="post">
                            @csrf
                            <div class="grid gap-6 grid-cols-3 items-end mb-8">
                                <div class="">
                                    <label for="from">{{__('From')}}</label>
                                    <input type="date" name="from" id="from" class="border rounded w-full px-2 py-3 shadow" value={{old('from')}}>
                                </div>
                                <div class="">
                                    <label for="to">{{__('To')}}</label>
                                    <input type="date" name="to" id="to" class="border rounded w-full px-2 py-3 shadow" value={{old('to')}}>
                                </div>
                                <div class="">
                                    <input type="submit" class="px-5 py-3 border rounded w-4/6 bg-slate-600 shadow text-cyan-100 cursor-pointer hover:bg-slate-800 hover:text-cyan-50" value="{{__('Submit')}}">
                                </div>
                            </div>
                        </form>
                        <div class="body grid gap-6 grid-cols-3">
                            <div class="shadow flex rounded px-5 items-center py-6 justify-between bg-slate-100">
                                <h3><strong>{{__('Total Owed')}}</strong></h3>
                                <div><span>{{ $casino_dones->total_owed }}</span></div>
                            </div>
                            <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                                <h3><strong>{{__('Projected Monthly')}}</strong></h3>
                                <span>{{ number_format($monthly_ev, 2) }}</span>
                            </div>
                            <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                                <h3><strong>{{__('Realised Profit')}}</strong></h3>
                                <span>{{ number_format($casino_dones->total_profit - $casino_dones ->total_owed, 2) }}</span>
                            </div>
                            <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                                <h3><strong>{{__('EV')}}</strong></h3>
                                <span>{{ $casino_dones->bonus_ev }}</span>
                            </div>
                            <div class="shadow flex rounded justify-between items-center px-5 py-6 bg-slate-100">
                                <h3><strong>{{__('Bonuses Done')}}</strong></h3>
                                <span>{{ $casino_dones->bonus_done }}</span>
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
                    </div>
                    <div class="">
                        <h2 class="mb-5 font-normal text-2xl">{{__('Chart View')}}</h2>
                        <div class="p-3 bg-slate-100 shadow rounded">
                            <canvas class="w-full" id="profitChart" data-profits={{$charts}}></canvas>
                        </div>
                    </div>
                </div>

                <br>
                <h2 class="text-2xl mt-7 mb-2">{{__('All Workers Last '.count($sevens).' days')}}</h2>
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




                {{-- Group lists --}}
                @foreach($groupreports as $worker)
                @if(count($worker->reports) <= 0) @continue @endif
                <br>
                <div class="flex justify-between  mt-7 mb-2">
                    <div><h2 class="text-2xl">{{ $worker->name }}</h2></div>
                    <div><h3><strong>{{__('Owed')}}: {{$worker->total_owed}}</strong></h3></div>
                </div>
                
                <div class="table w-full border rounded-md shadow-md">
                    <div class="table-header-group bg-slate-200">
                        <div class="table-row">
                            <div class="table-cell p-5"></div>
                            @foreach($worker->reports as $single) <div class="table-cell p-3">{{ date('d-M', strtotime($single->date)) }}</div>@endforeach
                            <div class="table-cell p-5"> {{__('Last '.count($worker->reports).' days')}}</div>
                        </div>
                    </div>
                    <div class="table-row-group">
                        <div class="table-row">
                            <div class="table-cell p-5">{{__('Bonus Value')}}</div>
                            @php $total_bonus_value = 0; @endphp
                            @foreach($worker->reports as $single) 
                                <div class="table-cell p-3">{{ $single->bonus_value }}</div>
                                @php $total_bonus_value += $single->bonus_value; @endphp
                            @endforeach
                            <div class="table-cell p-5">{{$total_bonus_value}}</div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell p-5">{{__('Bonuses Done')}}</div>
                            @php $total_bonus_done = 0; @endphp
                            @foreach($worker->reports as $single)
                                <div class="table-cell p-3">{{ $single->bonus_done }}</div>
                                @php $total_bonus_done += $single->bonus_done; @endphp
                            @endforeach
                            <div class="table-cell p-5">{{$total_bonus_done}}</div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell p-5">{{__('EV')}}</div>
                            @php $total_bonus_ev = 0; @endphp
                            @foreach($worker->reports as $single) 
                                <div class="table-cell p-3">{{ $single->bonus_ev }}</div>
                                @php $total_bonus_ev += $single->bonus_ev; @endphp
                            @endforeach
                            <div class="table-cell p-5">{{$total_bonus_ev}}</div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell p-5">{{__('Profit')}}</div>
                            @php $total_profit = 0; @endphp
                            @foreach($worker->reports as $single) 
                                <div class="table-cell p-3">{{ $single->bonus_profit }}</div>
                                @php $total_profit += $single->bonus_profit; @endphp
                            @endforeach
                            <div class="table-cell p-5">{{$total_profit}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

   
@endsection