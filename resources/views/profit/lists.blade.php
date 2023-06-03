@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt w-full px-5 py-8">
        <div class="w-2/4 m-auto mt-9 justify-center">
            @if(session('success'))
                <div class="alert px-6 py-3 bg-blue-400 text-white mb-3 rounded">{{session('success')}}</div>
            @endif
            <div class="table shadow-md rounded-md">
                    <div class="slotWrap border table-header-group rounded-md">
                        <div class="header text-gray-800 bg-gray-200 px-6 py-2 table-row">
                            <div class="px-2 py-3 flex-auto w-1/4 table-cell">{{ __('Date') }}</div>
                            <div class="px-2 py-3 flex-auto w-1/6 table-cell">{{__('Profit')}}</div>
                            <div class="px-2 py-3 flex-auto w-1/4 table-cell">{{__('Profit+')}}</div>
                            <div class="px-2 py-3 flex-auto w-1/4 table-cell">{{__('Bonuses')}}</div>
                            <div class="px-2 py-3 flex-auto w-1/4 table-cell">{{__('EV')}}</div>
                            <div class="px-2 py-3 flex-auto w-1/4 table-cell">{{__('EV+')}}</div>
                            <div class="px-2 py-3 flex-auto w-1/4 table-cell">{{__('Reloads')}}</div>
                            <div class="px-2 py-3 flex-auto w-1/4 table-cell">{{__('SUBs')}}</div>
                        </div>
                    </div>
                    <div class="body table-row-group">
                        @php 
                            $profit_plus =  $profits && isset($profits[0]) ? $profits[0]->profit : 0; 
                            $ev_plus = 0;
                        @endphp
                        
                        @foreach($profits as $k => $profit)
                            @php 
                                if($k > 0){
                                    $profit_plus += $profit->profit; 
                                    $ev_plus = $ev_plus + ($profit->total_bonus * 0.45);
                                }
                            @endphp
                            <div class="singleslot px-6 py-2 table-row">
                                <div class="px-2 table-cell py-3 flex-auto w-1/4">{{ $profit->date }}</div>
                                <div class="px-2 py-3 table-cell gap-4 flex-auto w-1/4">{{$profit->profit}}</div>
                                <div class="px-2 py-3 table-cell gap-4 flex-auto w-1/4">{{$profit_plus}}</div>
                                <div class="px-2 py-3 table-cell gap-4 flex-auto w-1/4">{{$profit->total_bonus}}</div>
                                <div class="px-2 py-3 table-cell gap-4 flex-auto w-1/4">{{$profit->total_bonus * 0.45}}</div>
                                <div class="px-2 py-3 table-cell gap-4 flex-auto w-1/4">{{$ev_plus + ($profit->total_bonus * 0.45)}}</div>
                                <div class="px-2 py-3 table-cell gap-4 flex-auto w-1/4">{{$profit->reload}}</div>
                                <div class="px-2 py-3 table-cell gap-4 flex-auto w-1/4">{{$profit->sub}}</div>
                            </div>
                            
                        @endforeach
                    </div>
            </div>
        </div>
    </div>


   
@endsection