@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt content-center justify-center w-full mt-10">
        <div class="grid h-full content-center justify-center">
            <h2 class="text-center bold mb-5 text-2xl"><strong>{{ Route::is('gnomeinfo.create') ? __('New Gnome') : __('Update Gnome') }}</strong></h2>
            <div class="grid w-full m-auto content-item-center h-full justify-center">
                <form 
                    @if(Route::is('gnomeinfo.create'))
                        action="{{route('gnomeinfo.store')}}"
                    @else 
                        action="{{route('gnomeinfo.update', $gnome)}}"
                    @endif                    
                    method="post">
                    @if(!Route::is('gnomeinfo.create'))
                        @method('PATCH')
                    @endif
                    @csrf
                    <div class="grid content-center grid-cols-3 gap-10 w-full justify-center">
                        <div class="">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('name') ? 'border-orange-600' : '' }}" id="name" value="{{isset($gnome) && $gnome->name ? $gnome->name : ''}}">
                            @if($errors->get('name')) <div class="text-orange-600"><small>{{$errors->first('name')}}</small></div> @endif
                        </div>
                        <div class="">
                            <label for="country">{{__('Country')}}</label>
                            <input type="text" name="country" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('country') ? 'border-orange-600' : '' }}" id="country" value="{{isset($gnome) && $gnome->country ? $gnome->country : ''}}">
                            @if($errors->get('country')) <div class="text-orange-600"><small>{{$errors->first('country')}}</small></div> @endif
                        </div>
                        <div class="">
                            <label for="code">{{__('Code')}}</label>
                            <input type="text" name="code" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('code') ? 'border-orange-600' : '' }}" id="code" value="{{isset($gnome) && $gnome->code ? $gnome->code : ''}}">
                            @if($errors->get('code')) <div class="text-orange-600"><small>{{$errors->first('code')}}</small></div> @endif
                        </div>
                        <div class="">
                            <label for="worker">{{__('Worker')}}</label>
                            <select name="worker" id="worker" class="border rounded px-2 py-2.5 mr-2 w-full shadow">
                                <option value="">{{__('Worker...')}}</option>
                                @foreach($workers as $worker)
                                    <option {{ isset($gnome) && $worker->id == $gnome->worker ? 'selected' : '' }} value="{{$worker->id}}">{{$worker->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="email">{{__('Email')}}</label>
                            <input type="email" name="email" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('email') ? 'border-orange-600' : '' }}" id="email" value="{{isset($gnome) && $gnome->email ? $gnome->email : ''}}">
                            @if($errors->get('email')) <div class="text-orange-600"><small>{{$errors->first('email')}}</small></div> @endif
                        </div>
                        <div class="">
                            <label for="wallet_id">{{__('Wallet ID')}}</label>
                            <input type="text" placeholder="{{__('Wallet ID')}}" name="wallet_id" class="border rounded p-2 mr-2 w-full shadow" id="wallet_id" value="{{isset($gnome) && $gnome->wallet_id ? $gnome->wallet_id : ''}}">
                        </div>
                        <div class="col-span-3 flex justify-end">
                            <button type="submit" class="btn justify-end py-2 hover:bg-gray-900 hover:text-gray-50 transition  border px-5 rounded-md">{{Route::is('gnomeinfo.create') ? __('Submit') : __('Update')}}</button>
                        </div>
                    </div>  
                </form>
            </div>
            {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-center w-full mt-3 text-red-500"><small>{{$error}}</small></div>
                @endforeach
            @endif --}}
        </div>
    </div>
@endsection