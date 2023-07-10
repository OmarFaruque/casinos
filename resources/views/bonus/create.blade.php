@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt content-center justify-center w-full px-6">
        <a style="margin-top: 30px; margin-left: 30px;" class="mt-15 ml-18 inline-block bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900" href="{{route('bonus.index')}}">{{ __('Bonus List') }}</a>
        <div class="grid h-full content-center justify-center px-6 mt-4">
            <h2 class="text-center bold mb-5 text-2xl"><strong>{{__('New Bonus')}}</strong></h2>
            <div class="grid w-full m-auto content-item-center h-full justify-center">
            {{-- {{dd($bonus)}} --}}
                <form 

                    
                    @if(Route::is('bonus.create'))
                        action="{{route('bonus.store')}}"
                    @else 
                        action="{{route('bonus.update', $bonus)}}"
                    @endif   
                
                    method="post">
                    @if(!Route::is('bonus.create'))
                        @method('PATCH')
                    @endif
                    @csrf
                    <div class="grid content-center grid-cols-3 gap-10 w-full justify-center">
                        {{-- <div class="">
                            <label for="gnome">{{__('Gnome')}}</label>
                            <select id="gnome" name="gnome" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('gnome') ? 'border-orange-600' : '' }}">
                                <option value="">{{__('Select Gnome...')}}</option>
                                @foreach($gnomes as $gnome)
                                    <option {{ isset($bonus) && $gnome->id == $bonus->gnome ? 'selected' : '' }} value="{{$gnome->id}}">{{$gnome->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->get('gnome')) <div class="text-orange-600"><small>{{$errors->first('gnome')}}</small></div> @endif
                        </div> --}}

                        <div class="">
                            <label for="casino_name">{{__('Casino Name')}}</label>
                            <select id="casino_name" name="casino_name" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('casino_name') ? 'border-orange-600' : '' }}">
                                <option value="">{{__('Select Casino...')}}</option>
                                @foreach($casinos as $casino)
                                    <option {{ isset($bonus) && $casino->id == $bonus->casino_name ? 'selected' : '' }} value="{{$casino->id}}">{{$casino->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->get('casino_name')) <div class="text-orange-600"><small>{{$errors->first('casino_name')}}</small></div> @endif
                        </div>
                        {{-- <div class="">
                            <label for="casino_lookup">{{__('Casino Lookup')}}</label>
                            <input type="text" name="casino_lookup" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('casino_lookup') ? 'border-orange-600' : '' }}" id="name" value="{{isset($bonus) && $bonus->casino_lookup ? $bonus->casino_lookup : ''}}">
                            @if($errors->get('casino_lookup')) <div class="text-orange-600"><small>{{$errors->first('casino_lookup')}}</small></div> @endif
                        </div> --}}

                        {{-- <div class="">
                            <label for="prtn">{{__('Prtn')}}</label>
                            <input type="number" name="prtn" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('prtn') ? 'border-orange-600' : '' }}" id="prtn" value="{{isset($bonus) && $bonus->prtn ? $bonus->prtn : ''}}">
                        </div> --}}

                        <div class="">
                            <label for="group">{{__('Group')}}</label>
                            <select id="group" name="group" class="border rounded p-2 mr-2 w-full shadow">
                                <option value="">{{__('Select Group...')}}</option>
                                @foreach($groups as $group)
                                    <option {{ isset($bonus) && $group->id == $bonus->group ? 'selected' : '' }} value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <label for="deposit">{{__('Deposit')}}</label>
                            <input type="number" name="deposit" class="border rounded p-2 mr-2 w-full shadow" id="deposit" value="{{isset($bonus) && $bonus->deposit ? $bonus->deposit : ''}}">
                        </div>
                        <div class="">
                            <label for="bonus">{{__('Bonus')}}</label>
                            <input type="number" name="bonus" class="border rounded p-2 mr-2 w-full shadow" id="bonus" value="{{isset($bonus) && $bonus->bonus ? $bonus->bonus : ''}}">
                        </div>

                        <div class="">
                            <label for="wagering_name">{{__('Wagering Type')}}</label>
                            <select id="wagering_name" name="wagering_name" class="border rounded p-2 mr-2 w-full shadow">
                                <option value="">{{__('Select...')}}</option>
                                <option {{ isset($bonus) && 'xb' == $bonus->wagering_name ? 'selected' : '' }} value="xb">xB</option>
                                <option {{ isset($bonus) && 'xdb' == $bonus->wagering_name ? 'selected' : '' }} value="xdb">x(D+B)</option>
                            </select>
                        </div>

                        <div class="">
                            <label for="payment_methods">{{__('Payment Methods')}}</label>
                            <select id="payment_methods" multiple="multiple" name="payment_methods[]" class="border rounded p-2 mr-2 w-full shadow select2">
                                <option value="">{{__('Select a payment...')}}</option>
                                @foreach($p_methods as  $k => $method)
                                    <option {{ isset($bonus) && $method == $bonus->payment_methods ? 'selected' : '' }} value="{{ $k}}">{{$method}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <label for="wagering_value">{{__('Wagering Value')}}</label>
                            <input type="wagering_value" name="wagering_value" class="border rounded p-2 mr-2 w-full shadow" id="bonus" value="{{isset($bonus) && $bonus->wagering_value ? $bonus->wagering_value : ''}}">
                        </div>

                        <div class="">
                            <label for="country_banned">{{__('Country Banned')}}</label>
                            <select id="country_banned" name="country_banned[]" multiple="multiple" class="border rounded p-2 mr-2 w-full shadow select2">
                                <option value="">{{__('Select countries...')}}</option>
                                @foreach($countries as  $k => $country)
                                    <option {{ isset($bonus) && is_array($bonus->country_banned) && in_array($k, $bonus->country_banned) ? 'selected' : '' }} value="{{ $k}}">{{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="">
                            <label for="gnome_done_casino">{{__('Last Time Gnome Done Casino Group')}}</label>
                            <input type="number" min="0" name="gnome_done_casino" class="border rounded p-2 mr-2 w-full shadow" id="bonus" value="{{isset($bonus) && $bonus->gnome_done_casino ? $bonus->gnome_done_casino : ''}}">
                        </div>
                        <div class="">
                            <label for="anyone_done_casino">{{__('Last Time Anyone Done Casino')}}</label>
                            <input type="number" min="0" name="anyone_done_casino" class="border rounded p-2 mr-2 w-full shadow" id="bonus" value="{{isset($bonus) && $bonus->anyone_done_casino ? $bonus->anyone_done_casino : ''}}">
                        </div>
                        <div class="">
                            <label for="anyone_done_group">{{__('Last Time Anyone Done Group')}}</label>
                            <input type="number" min="0" name="anyone_done_group" class="border rounded p-2 mr-2 w-full shadow" id="bonus" value="{{isset($bonus) && $bonus->anyone_done_group ? $bonus->anyone_done_group : ''}}">
                        </div>
                        <div class="">
                            <label for="gnome_pending_payout">{{__('Pending Payouts for Gnome in this Group')}}</label>
                            <input type="number" min="0" name="gnome_pending_payout" class="border rounded p-2 mr-2 w-full shadow" id="bonus" value="{{isset($bonus) && $bonus->gnome_pending_payout ? $bonus->gnome_pending_payout : ''}}">
                        </div>
                        <div class="">
                            <label for="everyone_pending_payout">{{__('Total Pending Payouts for Everyone for this Group')}}</label>
                            <input type="number" min="0" name="everyone_pending_payout" class="border rounded p-2 mr-2 w-full shadow" id="bonus" value="{{isset($bonus) && $bonus->everyone_pending_payout ? $bonus->everyone_pending_payout : ''}}">
                        </div>
                        <div class="">
                            <label for="everyone_sub_pending_payout">{{__('SUB Pending Payouts for Everyone in this Group')}}</label>
                            <input type="number" min="0" name="everyone_sub_pending_payout" class="border rounded p-2 mr-2 w-full shadow" id="bonus" value="{{isset($bonus) && $bonus->everyone_sub_pending_payout ? $bonus->everyone_sub_pending_payout : ''}}">
                        </div>
                        <div class="col-span-3">
                            <label for="notes">{{__('Notes')}}</label>
                            <input type="text" name="notes" class="border rounded p-2 mr-2 w-full shadow" id="bonus" value="{{isset($bonus) && $bonus->notes ? $bonus->notes : ''}}">
                        </div>


                        <div class="flex items-end">
                            <button type="submit" class="btn justify-end py-2 hover:bg-gray-900 hover:text-gray-50 transition  border px-5 rounded-md">{{Route::is('bonus.create') ? __('Submit') : __('Update')}}</button>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
@endsection