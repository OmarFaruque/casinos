
@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt w-full px-5 py-8">
        <a class="bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900" href="{{route('workers.create')}}">{{ __('New Entry') }}</a>
        
        <div class="w-ful m-auto mt-9 justify-center">
            @if(session('success'))
                <div class="alert px-6 py-3 bg-blue-400 text-white mb-3 rounded">{{session('success')}}</div>
            @endif
            <table class="slotWrap border rounded-md shadow-md dataTableWorkers w-full">
                <thead>
                    <tr class="header text-gray-800 bg-gray-200 px-6 py-2 w-full">
                        <th class="px-2 py-3 flex-auto ">{{ __('Name') }}</th>
                        <th class="px-2 py-3 flex-auto ">{{ __('Assigned User') }}</th>
                        <th class="px-2 py-3 flex-auto ">{{ __('Owed') }}</th>
                        <th class="px-2 py-3 flex-auto none">{{__('Assigned Gnome')}}</th>
                        <th class="px-2 py-3 flex-auto ">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody class="body">
                    @foreach($workers as $k => $worker)
                        <tr class="singleslot px-6 py-2">
                            <td class="px-2 py-3">{{ $worker->name }}</td>
                            <td class="px-2 py-3 flex-auto ">{{ !empty($worker->display_name) ? $worker->display_name : $worker->user_name }}</td>
                            <td class="px-2 py-3 flex-auto ">{{ $worker->owed }}</td>
                            <td class="px-2 py-3 flex-auto ">{{ $worker->gnomes }}</td>
                            <td class="px-2 py-3 flex gap-4 flex-auto">
                                <a href="{{route('workers.edit', $worker)}}" class="px-3 py-3 border rounded hover:text-gray-50 hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <form method="post" action="{{ route('workers.destroy', $worker) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="px-3 py-3 border rounded hover:text-gray-50 hover:bg-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   
@endsection