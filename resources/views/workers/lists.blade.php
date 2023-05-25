@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt w-full px-5 py-8">
        <a class="bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900" href="{{route('workers.create')}}">{{ __('Create') }}</a>

        <div class="w-2/4 m-auto mt-9 justify-center">
            <table class="table-auto w-full rounded-md">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr class="border-bottom">
                        <th class="p-2 text-left">SL</th>
                        <th class="text-left p-2">{{ __('Name') }}</th>
                        <th class="text-left p-2">{{ __('Action') }}</th>
                    </tr>
                    <tbody>
                         @foreach($workers as $k => $worker)
                            <tr class="{{ $k % 2 == 0 ? 'bg-gray-50' : '' }}">
                                <td class="p-2">{{$k + 1}}</td>
                                <td class="p-2">{{$worker->name}}</td>
                                <td class="p-2">
                                    <a class="btn px-5 py-2 border rounded hover:bg-gray-900 hover:text-gray-100" href="#">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                         @endforeach
                    </tbody>
                </thead>
    
            </table>
        </div>
    </div>

   
@endsection