
@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt w-full px-5 py-8">
        <a class="bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900" href="{{route('register.show')}}">{{ __('New Entry') }}</a>
        
        <div class="w-full m-auto mt-9 justify-center">
            @if(session('success'))
                <div class="alert px-6 py-3 bg-blue-400 text-white mb-3 rounded">{{session('success')}}</div>
            @endif
            <div class="slotWrap border rounded-md shadow-md table w-full">
                <div class="header text-gray-800 bg-gray-200 px-6 py-2 table-header-group">
                    <div class="table-row">
                        <div class="px-2 py-3 table-cell">{{ __('Name') }}</div>
                        <div class="px-2 py-3 table-cell">{{ __('Display Name') }}</div>
                        <div class="px-2 py-3 table-cell">{{ __('Email') }}</div>
                        <div class="px-2 py-3 table-cell">{{ __('Role') }}</div>
                        <div class="px-2 py-3 table-cell">{{__('Action')}}</div>
                    </div>
                </div>
                <div class="body table-row-group">
                    @foreach($users as $k => $user)
                        <div class="singleslot px-6 py-2 table-row">
                            <div class="px-2 py-3 table-cell">{{ $user->name }}</div>
                            <div class="px-2 py-3 table-cell">{{ $user->display_name  }}</div>
                            <div class="px-2 py-3 table-cell">{{ $user->email }}</div>
                            <div class="px-2 py-3 table-cell">{{ $user->role }}</div>
                            <div class="px-2 py-3 gap-4 table-cell">
                                <div class="flex gap-2">
                                    <a href="{{route('register.edit', $user)}}" class="px-3 py-3 border rounded hover:text-gray-50 hover:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    @if((Auth::user()->id != $user->id) && $user->role != 'administration')
                                    <form method="post" action="{{ route('register.destroy', $user) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="px-3 py-3 border rounded hover:text-gray-50 hover:bg-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

   
@endsection