@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt content-center justify-center w-full">
        <div class="grid h-full content-center justify-center">
            <h2 class="text-center bold mb-5 text-2xl"><strong>{{__('New Group')}}</strong></h2>
            <div class="grid w-full m-auto content-item-center h-full justify-center">
                <form 
                    @if(Route::is('casinos.create'))
                        action="{{route('casinos.store')}}"
                    @else 
                        action="{{route('casinos.update', $casino)}}"
                    @endif   
                
                    method="post">
                    @if(!Route::is('casinos.create'))
                        @method('PATCH')
                    @endif
                    @csrf
                    <div class="grid content-center grid-cols-3 gap-10 w-full justify-center">
                        <div class="col-span-2">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('name') ? 'border-orange-600' : '' }}" id="name" value="{{isset($casino) && $casino->name ? $casino->name : ''}}">
                            @if($errors->get('name')) <div class="text-orange-600"><small>{{$errors->first('name')}}</small></div> @endif
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="btn justify-end py-2 hover:bg-gray-900 hover:text-gray-50 transition  border px-5 rounded-md">{{Route::is('casinos.create') ? __('Submit') : __('Update')}}</button>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
@endsection