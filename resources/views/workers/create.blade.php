@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt content-center justify-center w-full mt-10">
        <div class="grid h-full content-center justify-center">
            <h2 class="text-center bold text-2xl mb-10">{{__('New Workers')}}</h2>
            <div class="flex flex-row w-full m-auto content-item-center h-full justify-center">
                <form 
                    @if(Route::is('workers.create'))
                        action="{{route('workers.store')}}"
                    @else 
                        action="{{route('workers.update', $worker)}}"
                    @endif   
                    method="post">
                    @if(!Route::is('workers.create'))
                        @method('PATCH')
                    @endif
                    @csrf
                    <div class="grid content-center grid-cols-3 gap-4 w-full justify-center">
                        <div class="">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="border rounded p-2 mr-2 w-full shadow" id="name" value="{{isset($worker) && $worker->name ? $worker->name : ''}}">
                        </div>
                        <div class="">
                            <label for="wallet_id">{{__('Wallet ID')}}</label>
                            <input type="text" name="wallet_id" class="border rounded p-2 mr-2 w-full shadow" id="wallet_id" value="{{isset($worker) && $worker->wallet_id ? $worker->wallet_id : ''}}">
                        </div>
                        <div class="">
                            <label for="assigned_user">{{__('Assigned User')}}</label>
                            {{-- {{dd($users)}} --}}
                            <select name="assigned_user" id="assigned_user" class="border rounded px-2 py-2.5 mr-2 w-full shadow">
                                <option value="">{{__('User...')}}</option>
                                @foreach($users as $user)
                                    <option {{ isset($worker) && $user->id == $worker->assigned_user ? 'selected' : '' }} value="{{$user->id}}">{{!empty($user->display_name) ? $user->display_name : $user->name }} - {{$user->email}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="content-center text-right col-span-3">
                            <input type="submit" class="p-2 cursor-pointer rounded border bg-gray-900 text-gray-200 px-6" value="{{Route::is('workers.create') ? __('Submit') : __('Update')}}">
                        </div>
                    </div>
                </form>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-center w-full mt-3 text-red-500"><small>{{$error}}</small></div>
                @endforeach
            @endif
        </div>
    </div>
@endsection