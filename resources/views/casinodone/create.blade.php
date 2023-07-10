@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt content-center justify-center w-full">
        <div class="grid h-full content-center justify-center">
            <h2 class="text-center bold mb-5 text-2xl mt-8">
                @if(Route::is('new-casino-done'))
                    {{__('New Entry')}}
                @else
                    {{__('Update Entry')}}
                @endif
            </h2>
            <div class="grid w-full m-auto content-item-center h-full justify-center">
                <form
                    @if(Route::is('new-casino-done'))
                        action="{{route('players.store')}}"
                    @else 
                        action="{{route('players.update', $done)}}"
                    @endif   
                    
                    method="post">
                    @csrf
                    @if(!Route::is('new-casino-done'))
                        @method('PATCH')
                    @endif

                    <div class="grid content-center grid-cols-3 gap-10 w-full justify-center">
                        <div class="">
                            <label for="name">{{__('Name')}}</label>
                            <select name="name" id="name" class="h-11 border rounded p-2 mr-2 shadow w-full {{ $errors->get('name') ? 'border-orange-600' : '' }}">
                                <option value="">{{__('Name...')}}</option>
                                @foreach($gnomes as $k => $name)
                                    <option {{isset($done) && $done->name == $name->id ? 'selected' : ''}}  value="{{$name->id}}">{{$name->name}}</option>
                                @endforeach
                            </select>
                            <a class="mt-5 text-gray-400 hover:text-gray-600" href="{{route('gnomeinfo.create')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus inline-block" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                                <small>{{__('Add New')}}</small>
                            </a>
                        </div>
                        <div class="">
                            <label for="date">{{__('Date')}}</label>
                            <input type="date" name="date" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('date') ? 'border-orange-600' : '' }}" id="date" value="{{ isset($done) ? $done->date : '' }}">
                        </div>
                        {{-- <div class="">
                            <label for="casino_bonus_lookup">{{__('Casino Bonus Lookup')}}</label>
                            <select name="casino_bonus_lookup" id="casino_bonus_lookup" class="h-11 border rounded p-2 mr-2 shadow w-full {{ $errors->get('casino_bonus_lookup') ? 'border-orange-600' : '' }}">
                                <option value="">{{__('Lookup...')}}</option>
                                @foreach($bonuses as $k => $bonus)
                                    <option {{isset($done) && $done->casino_bonus_lookup == $bonus->id ? 'selected' : ''}}  value="{{$bonus->id}}">{{$bonus->casino_lookup}}</option>
                                @endforeach
                            </select>
                            <a class="mt-5 text-gray-400 hover:text-gray-600" href="{{route('bonus.create')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus inline-block" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                                <small>{{__('Add New')}}</small>
                            </a>
                        </div> --}}
                        <div class="">
                            <label for="type">{{__('Type')}}</label>
                            <select name="type" id="type" class="border rounded p-2 mr-2 h-11 shadow w-full {{ $errors->get('type') ? 'border-orange-600' : '' }}">
                                <option value="">{{__('Type...')}}</option>
                                @foreach($types as $k => $type)
                                    <option {{isset($done) && $done->type == $k ? 'selected' : ''}} value="{{$k}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="casino">{{__('Casino')}}</label>
                            <select name="casino" id="casino" class="border rounded p-2 mr-2 h-11 shadow w-full {{ $errors->get('casino') ? 'border-orange-600' : '' }}">
                                <option value="">{{__('Select casino...')}}</option>
                                @foreach($casinos as $k => $casino)
                                    <option {{isset($done) && $done->casino == $casino->id ? 'selected' : ''}} value="{{$casino->id}}">{{$casino->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="group">{{__('Group')}}</label>
                            <select name="group" id="group" class="border rounded p-2 h-11 mr-2 shadow w-full">
                                <option value="">{{__('Select a group...')}}</option>
                                @foreach($groups as $k => $group)
                                    <option {{isset($done) && $done->group == $group->id ? 'selected' : ''}} value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="payment_method">{{__('Payment Method')}}</label>
                            <select class="border rounded p-2 mr-2 shadow w-full h-11" name="payment_method" id="payment_method">
                                <option value="">{{ __('Payment Method...') }}</option>
                                @foreach($payment_methods as $s => $pmethod)
                                    <option {{isset($done) && $done->payment_method == $s ? 'selected' : ''}} value="{{$s}}">{{$pmethod}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="deposit">{{__('Deposit')}}</label>
                            <input type="number" name="deposit" class="border rounded p-2 mr-2 shadow w-full" id="deposit" value="{{ isset($done) ? $done->deposit : '' }}">
                        </div>
                        <div class="">
                            <label for="bonus">{{__('Bonus')}}</label>
                            <input type="number" name="bonus" class="border rounded p-2 mr-2 shadow w-full" id="bonus" value="{{ isset($done) ? $done->bonus : '' }}">
                        </div>
                        <div class="">
                            <label for="balance">{{__('Balance')}}</label>
                            <input type="number" name="balance" class="border rounded p-2 mr-2 shadow w-full" id="balance" value="{{ isset($done) ? $done->balance : '' }}">
                        </div>
                        <div class="">
                            <label for="status">{{__('Status')}}</label>
                            <select name="status" id="status" class="border rounded h-11 p-2 mr-2 shadow w-full" >
                                @foreach($status_lists as $k => $status)
                                <option {{isset($done) && $done->status == $k ? 'selected' : ''}} value="{{$k}}">{{$status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <label for="partpaid">{{__('Part Paid')}}</label>
                            <input type="number" name="partpaid" class="border rounded p-2 mr-2 shadow w-full" id="partpaid" value="{{ isset($done) ? $done->partpaid : '' }}">
                        </div>
                        <div class="">
                            <label for="fainalpaid">{{__('Fainal Paid')}}</label>
                            <input type="number" name="fainalpaid" class="border rounded p-2 mr-2 shadow w-full" id="fainalpaid" value="{{ isset($done) ? $done->fainalpaid : 0 }}">
                        </div>

                        <div class="">
                            {{-- {{dd($slots)}} --}}
                            <label for="game_played">{{__('Game Played')}}</label>
                            <select name="game_played" id="game_played" class="h-11 border rounded p-2 mr-2 shadow w-full">
                                <option value="">{{ __('Select a slot')}}</option>
                                @foreach($slots as $k => $slot)
                                    <option {{isset($done) && $done->game_played == $slot->id ? 'selected' : ''}} value="{{ $slot->id }}">{{ $slot->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <label for="spin">{{__('Spin')}}</label>
                            <input type="number" name="spin" class="border rounded p-2 mr-2 shadow w-full" id="spin" value="{{ isset($done) ? $done->spin : '' }}">
                        </div>

                        <div class="">
                            <label for="rtp">{{__('RTP (%)')}}</label>
                            <input type="number" name="rtp" class="border rounded p-2 mr-2 shadow w-full" id="rtp" min="0" step="0.01" max="100" value="{{ isset($done) ? $done->rtp : '' }}">
                        </div>

                        {{-- <div class="col-span-2">
                            <label for="worker">{{__('Worker')}}</label>
                            <select name="worker" id="worker" class="h-11 border rounded p-2 mr-2 shadow w-full" >
                                <option value="">{{ __('Select a Worker') }}</option>
                                @foreach($workers as $worker)
                                    <option {{ isset($done) && $done->worker == $worker->id ? 'selected':'' }} value="{{ $worker->id }}">{{$worker->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="">
                            <label for="ipayment">{{__('Incoming Payment')}}</label>
                            <input type="number" name="ipayment" class="border rounded p-2 mr-2 shadow w-full" id="ipayment" min="0" step="1"  value="{{ isset($done) ? $done->ipayment : '' }}">
                        </div>
                        <div class="">
                            <label for="ipaydate">{{__('Incoming Payment Date')}}</label>
                            <input type="date" name="ipaydate" class="border rounded p-2 mr-2 shadow w-full" id="ipaydate"  value="{{ isset($done) ? $done->ipaydate : '' }}">
                        </div>

                        <div class="">
                            <label for="ipaynotes">{{__('Incoming Payment Notes')}}</label>
                            <input type="text" name="ipaynotes" class="border rounded p-2 mr-2 w-full shadow" id="ipaynotes" value="{{ isset($done) ? $done->ipaynotes : '' }}">
                        </div>

                        <div class="col-span-3">
                            <label for="notes">{{__('Notes')}}</label>
                            <input type="text" name="notes" class="border rounded p-2 mr-2 shadow w-full" id="notes" value="{{ isset($done) ? $done->notes : '' }}">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="btn justify-end py-2 hover:bg-gray-900 hover:text-gray-50 transition  border px-5 rounded-md">{{Route::is('new-casino-done') ? __('Submit') : __('Update')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection