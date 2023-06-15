@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt max-w-full w-full overflow-x-hidden ">
       <div class="px-5 py-8 w-full overflow-x-hidden">
        <a class="bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900" href="{{route('bonus.create')}}">{{ __('New Entry') }}</a>
        
        <div class="w-full m-auto mt-9 justify-center overflow-x-scroll max-w-full pb-5">
            @if(session('success'))
                <div class="alert px-6 py-3 bg-blue-400 text-white mb-3 rounded">{{session('success')}}</div>
            @endif

 

            <div class="slotWrap border rounded-md shadow-md w-full table min-w-full">
                <div class="header table-header-group text-gray-800 bg-gray-200 px-6 py-2 w-max">
                   <div class="table-row">
                        <div class="px-2 py-3 table-cell align-middle w-40 min-w-fit" style="min-width: 120px;">{{ __('Casino Name') }}</div>
                        {{-- <div class="px-2 py-3 table-cell align-middle w-28">{{ __('Lookup') }}</div> --}}
                        <div class="px-2 py-3 table-cell align-middle">{{ __('Prtn') }}</div>
                        <div class="px-2 py-3 table-cell align-middle w-24" style="min-width: 100px;">{{ __('Group') }}</div>
                        <div class="px-2 py-3 table-cell align-middle">{{ __('Deposit') }}</div>
                        <div class="px-2 py-3 table-cell align-middle">{{ __('Bonus') }}</div>
                        <div class="px-2 py-3 table-cell align-middle">{{ __('Profit(%)') }}</div>
                        <div class="px-2 py-3 table-cell align-middle w-24" style="min-width: 100px;">{{ __('Can Do?') }}</div>
                        <div class="px-2 py-3 table-cell align-middle">{{ __('Done?') }}</div>
                        <div class="px-2 py-3 table-cell align-middle w-24 tooltip-bottom-right" data-tooltip="{{__('Wagering Requirements (x? | x | $total | xB?)')}}">
                            {{ __('Wagering') }}
                        </div>
                        <div class="px-2 py-3 table-cell align-middle" style="min-width: 150px;">{{ __('Pay. Methods') }}</div>
                        <div class="tooltip-bottom px-2 py-3 table-cell align-middle" data-tooltip="{{__('If not banned (Country | Casino | Group)')}}">
                            {{ __('Ok to Play?') }}
                        </div>
                        <div class="px-2 py-3 table-cell align-middle w-24 tooltip-bottom" data-tooltip="{{__('Last Time Gnome Done Casino Group (Criteria | Last Done | Ok?)')}}">
                            {{ __('Done Group') }}
                        </div>

                        <div class="px-2 py-3 table-cell align-middle flex-auto tooltip-bottom w-36" data-tooltip="{{__('Last Time Anyone Done Casino (Criteria | Last Done | Ok?)')}}">
                            {{ __('Any. Casino') }}
                        </div>
                        <div class="px-2 py-3 table-cell align-middle flex-auto tooltip-bottom w-32" data-tooltip="{{__('Last Time Anyone Done Group (Criteria | Last Done | Ok?)')}}">
                            {{ __('Any. Group') }}
                        </div>
                        <div class="px-2 py-3 table-cell align-middle flex-auto tooltip-bottom" data-tooltip="{{__('Pending Payouts for Gnome in this Group (Criteria | Owed | Ok?)')}}">
                            {{ __('Pen. Payout') }}
                        </div>
                        <div class="px-2 py-3 table-cell align-middle flex-auto tooltip-bottom w-40" data-tooltip="{{__('Total Pending Payouts for Everyone for this Group (Criteria | Owed | Ok?)')}}">
                            {{ __('Every. Payout') }}
                        </div>
                        <div class="px-2 py-3 flex-auto table-cell align-middle tooltip-bottom-right" data-tooltip="{{__('SUB Pending Payouts for Everyone in this Group (Criteria | Owed | Ok?)')}}">
                            {{ __('Sub Payout') }}
                        </div>
                        <div class="px-2 py-3 flex-auto">{{__('Action')}}</div>
                   </div>
                </div>
                <div class="body table-row-group">
                    @foreach($bonuss as $bonus)
                        <div class="singleslot table-row px-6 py-2">
                            <div class="px-2 py-3 table-cell align-middle ">{{ $bonus->casino_name }}</div>
                            {{-- <div class="px-2 py-3 table-cell align-middle ">{{ $bonus->casino_lookup }}</div> --}}
                            <div class="px-2 py-3 table-cell align-middle ">{{ $bonus->prtn }}</div>
                            <div class="px-2 py-3 table-cell align-middle ">{{ $bonus->group_name }}</div>
                            <div class="px-2 py-3 table-cell align-middle ">€&nbsp;{{ $bonus->deposit ? $bonus->deposit : 0 }}</div>
                            <div class="px-2 py-3 table-cell align-middle ">€&nbsp;{{ $bonus->bonus ? $bonus->bonus : 0 }}</div>
                            <div class="px-2 py-3 table-cell align-middle ">{{ $bonus->profit }}</div>
                            <div class="px-2 py-3 table-cell align-middle ">{{ $bonus->cando }}</div>
                            <div class="px-2 py-3 table-cell align-middle ">{{ $bonus->done }}</div>

                            <div class="px-2 py-3 flex-auto table-cell align-middle ">
                                <div class="flex w-100">
                                    <div class="border p-1 px-2">{{$bonus->wagering_name}}</div>
                                    <div class="border p-1 px-2">{{$bonus->wagering_value}}</div>
                                    <div class="border p-1">{{$bonus->wagering_total}}</div>
                                    <div class="border p-1">{{number_format($bonus->wagering_total/$bonus->bonus, 2)}}</div>
                                </div>
                            </div>


                            <div class="px-2 py-3 flex-auto table-cell align-middle ">{{ implode(' | ', $bonus->payment_methods) }}</div>
                            <div class="px-2 py-3 flex-auto table-cell align-middle ">
                                <div class="flex w-100">
                                    <div class="border p-1 px-2">{{$bonus->ok_to_play_country}}</div>
                                    <div class="border p-1 px-2">{{ $bonus->ok_to_play_casino }}</div>
                                    <div class="border p-1">{{$bonus->ok_to_play_group}}</div>
                                </div>
                            </div>
                            <div class="px-2 py-3 flex-auto table-cell align-middle ">
                                <div class="flex w-100">
                                    <div class="border p-1 px-2">{{ $bonus->gnome_done_casino ? $bonus->gnome_done_casino : 0}}</div>
                                    <div class="border p-1 px-2">{{ $bonus->last_gnome_done_casino }}</div>
                                    <div class="border p-1">{{ $bonus->gnome_done_casino_ok }}</div>
                                </div>
                            </div>
                            <div class="px-2 py-3 flex-auto table-cell align-middle">
                                <div class="flex w-100">
                                    <div class="border p-1 px-2">{{ $bonus->anyone_done_casino ? $bonus->anyone_done_casino : 0}}</div>
                                    <div class="border p-1 px-2">{{ $bonus->last_anyone_done_casino }}</div>
                                    <div class="border p-1">{{ $bonus->anyone_done_casino_ok }}</div>
                                </div>
                            </div>
                            <div class="px-2 py-3 flex-auto table-cell align-middle">
                                <div class="flex w-100">
                                    <div class="border p-1 px-2">{{ $bonus->anyone_done_group ? $bonus->anyone_done_group : 0}}</div>
                                    <div class="border p-1 px-2">{{ $bonus->last_anyone_done_group }}</div>
                                    <div class="border p-1">{{ $bonus->anyone_done_group_ok }}</div>
                                </div>
                            </div>
                            <div class="px-2 py-3 flex-auto table-cell align-middle">
                                <div class="flex w-100">
                                    <div class="border p-1 px-2">{{ $bonus->gnome_pending_payout ? $bonus->gnome_pending_payout : 0}}</div>
                                    <div class="border p-1 px-2">{{ $bonus->pp_gnome_group }}</div>
                                    <div class="border p-1">{{ $bonus->pp_gnome_group_ok }}</div>
                                </div>
                            </div>
                            <div class="px-2 py-3 flex-auto table-cell align-middle">
                                <div class="flex w-100">
                                    <div class="border p-1 px-2">{{ $bonus->everyone_pending_payout ? $bonus->everyone_pending_payout : 0}}</div>
                                    <div class="border p-1 px-2">{{ $bonus->tpp_gnome_everyone_in_group }}</div>
                                    <div class="border p-1">{{ $bonus->tpp_gnome_everyone_in_group_ok }}</div>
                                </div>
                            </div>
                            <div class="px-2 py-3 flex-auto table-cell items-center justify-center align-middle">
                                <div class="flex w-100">
                                    <div class="border p-1 px-2">{{ $bonus->everyone_sub_pending_payout ? $bonus->everyone_sub_pending_payout : 0}}</div>
                                    <div class="border p-1 px-2">{{ $bonus->spp_gnome_everyone_in_group }}</div>
                                    <div class="border p-1">{{ $bonus->spp_gnome_everyone_in_group_ok }}</div>
                                </div>
                            </div>
                            <div class="px-2 py-3 gap-4 flex-auto items-center justify-center flex">
                                {{-- <div class="flex items-center h-full"> --}}
                                    <a href="{{route('bonus.edit', $bonus)}}" class="px-2 py-2 border rounded hover:text-gray-50 hover:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <form method="post" action="{{ route('bonus.destroy', $bonus) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="p-2 border rounded hover:text-gray-50 hover:bg-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                {{-- </div> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
       </div>
    </div>

   

    
@endsection