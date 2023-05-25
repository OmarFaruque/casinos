@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt content-center justify-center w-full">
        <div class="grid h-full content-center justify-center">
            <h2 class="text-center bold mb-5">{{__('New Workers')}}</h2>
            <div class="flex flex-row w-full m-auto content-item-center h-full justify-center">
                <form action="{{route('workers.store')}}" method="post">
                    @csrf
                    <div class="flex content-center grid-cols-4 gap-4 w-full justify-center">
                        <div class="">
                            <input type="text" name="name" class="border rounded p-2 mr-2 w-full" id="name" value="">
                        </div>
                        <div class="flex content-center">
                            <input type="submit" class="p-2 rounded border bg-gray-900 text-gray-200 px-6" value="{{__('Submit')}}">
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