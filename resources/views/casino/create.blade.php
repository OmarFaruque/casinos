@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt content-center justify-center w-full">
        <a style="margin-top: 30px; margin-left: 30px;" class="mt-15 ml-18 inline-block bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900" href="{{route('casinos.index')}}">{{ __('Casinos List') }}</a>
        {{-- <li> --}}
            <a href="{{route('groups.index')}}" class="mt-15 ml-30 inline-block bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900">{{__('Group Lists')}}</a>
        {{-- </li> --}}
        {{-- <li> --}}
            <a href="{{route('groups.create') }}" class="mt-15 ml-30 inline-block bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900">{{ __('Add New Group') }}</a>
        {{-- </li> --}}
        <div class="grid h-full content-center justify-center">
            <h2 class="text-center bold mb-5 mt-10 text-2xl"><strong>{{ Route::is('casinos.create') ? __('New Casino') : __('Update Casino') }}</strong></h2>
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
                    <div class="grid content-center grid-cols-6 gap-10 w-full justify-center">
                        <div class="col-span-2">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('name') ? 'border-orange-600' : '' }}" id="name" value="{{isset($casino) && $casino->name ? $casino->name : ''}}">
                            @if($errors->get('name')) <div class="text-orange-600"><small>{{$errors->first('name')}}</small></div> @endif
                        </div>
                        <div class="col-span-2">
                            <label for="group_id">{{__('Group')}}</label>
                            <select name="group_id" id="group_id" class="border rounded p-2 h-11 mr-2 shadow w-full">
                                <option value="">{{__('Select a group...')}}</option>
                                @foreach($groups as $k => $group)
                                    <option {{isset($casino) && $casino->group_id == $group->id ? 'selected' : ''}} value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                            
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