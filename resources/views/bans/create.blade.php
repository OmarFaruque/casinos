@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt content-center justify-center w-full">
        <div class="grid h-full content-center justify-center">
            <h2 class="text-center bold mb-5 text-2xl"><strong>
                @if(Route::is('bans.create'))
                    {{__('New Ban')}}
                @else
                    {{__('Update Ban')}}
                @endif
            </strong></h2>
            <div class="grid w-full m-auto content-item-center h-full justify-center">
                <form 
                    @if(Route::is('bans.create'))
                        action="{{route('bans.store')}}"
                    @else 
                        action="{{route('bans.update', $bans)}}"
                    @endif   
                
                    method="post">
                    @if(!Route::is('bans.create'))
                        @method('PATCH')
                    @endif
                    @csrf
                    <div class="grid content-center grid-cols-3 gap-10 w-full justify-center">
                        <div class="">
                            <label for="gnome">{{__('Gnome')}}</label>
                            <select id="gnome" name="gnome" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('gnome') ? 'border-orange-600' : '' }}">
                                <option value="">{{__('Select Gnome...')}}</option>
                                @foreach($gnomes as $gnome)
                                    <option {{ isset($bans) && $gnome->id == $bans->gnome ? 'selected' : '' }} value="{{$gnome->id}}">{{$gnome->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->get('gnome')) <div class="text-orange-600"><small>{{$errors->first('gnome')}}</small></div> @endif
                        </div>

                        <div class="">
                            <label for="casino">{{__('Casino')}}</label>
                            <select id="casino" name="casino" class="border rounded p-2 mr-2 w-full shadow {{ $errors->get('casino') ? 'border-orange-600' : '' }}">
                                <option value="">{{__('Select Casino...')}}</option>
                                @foreach($casinos as $casino)
                                    <option {{ isset($bans) && $casino->id == $bans->casino ? 'selected' : '' }} value="{{$casino->id}}">{{$casino->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->get('casino')) <div class="text-orange-600"><small>{{$errors->first('casino')}}</small></div> @endif
                        </div>
                        <div class="">
                            <label for="group">{{__('Group')}}</label>
                            <select id="group" name="group" class="border rounded p-2 mr-2 w-full shadow">
                                <option value="">{{__('Select Group...')}}</option>
                                @foreach($groups as $group)
                                    <option {{ isset($bans) && $group->id == $bans->group ? 'selected' : '' }} value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-3 flex justify-end">
                            <button type="submit" class="btn justify-end py-2 hover:bg-gray-900 hover:text-gray-50 transition  border px-5 rounded-md">{{Route::is('bans.create') ? __('Submit') : __('Update')}}</button>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
@endsection