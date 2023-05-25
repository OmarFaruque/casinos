@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt content-center justify-center w-full">
        <div class="grid h-full content-center justify-center">
            <h2 class="text-center bold mb-5 text-2xl"><strong>{{__('New Slot')}}</strong></h2>
            <div class="grid w-full m-auto content-item-center h-full justify-center">
                <form 
                    @if(Route::is('slot.create'))
                        action="{{route('slot.store')}}"
                    @else 
                        action="{{route('slot.update', $slot)}}"
                    @endif   
                
                    method="post">
                    @if(!Route::is('slot.create'))
                        @method('PATCH')
                    @endif
                    @csrf
                    <div class="grid content-center grid-cols-3 gap-10 w-full justify-center">
                        <div class="">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('name') ? 'border-orange-600' : '' }}" id="name" value="{{isset($slot) && $slot->name ? $slot->name : ''}}">
                            @if($errors->get('name')) <div class="text-orange-600"><small>{{$errors->first('name')}}</small></div> @endif
                        </div>
                        <div class="">
                            <label for="he">{{__('HE')}}</label>
                            <input type="number" step="0.01" min="0" max="100" name="he" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('he') ? 'border-orange-600' : '' }}" id="he" value="{{isset($slot) && $slot->he ? $slot->he : ''}}">
                            @if($errors->get('he')) <div class="text-orange-600"><small>{{$errors->first('he')}}</small></div> @endif
                        </div>
                        <div class="">
                            <label for="provider">{{__('Provider')}}</label>
                            <input type="text" name="provider" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('provider') ? 'border-orange-600' : '' }}" id="provider" value="{{isset($slot) && $slot->provider ? $slot->provider : ''}}">
                            @if($errors->get('provider')) <div class="text-orange-600"><small>{{$errors->first('provider')}}</small></div> @endif
                        </div>
                        <div class="col-span-3 flex justify-end">
                            <button type="submit" class="btn justify-end py-2 hover:bg-gray-900 hover:text-gray-50 transition  border px-5 rounded-md">{{Route::is('slot.create') ? __('Submit') : __('Update')}}</button>
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