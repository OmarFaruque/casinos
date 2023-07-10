@extends('layouts.app-master')

@section('content')
    <div class="listsconetnt w-full px-5 py-8">
        {{-- <a class="bg-gray-200 py-3 px-5 rounded text-gray-900 hover:text-gray-200 hover:bg-gray-900" href="{{route('new-casino-done')}}">{{ __('New Entry') }}</a> --}}
        @if($user_worker_id || Auth::user()->role == 'administrator')
        <div class="w-full m-auto mt-9">
            @if(session('success'))
                <div class="alert px-6 py-3 bg-blue-400 text-white mb-3 rounded">{{session('success')}}</div>
            @endif
            <table class="dataTableIncomentPayment slotWrap border shadow-md table w-full" >
                <thead class="table-header-group w-max">
                    <tr class=" table-row text-gray-800 bg-gray-200 px-6 py-2">
                        <th class="px-2 py-3 table-cell ">{{ __('Name') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Date') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Incoming Payment') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Incoming Date') }}</th>
                        {{-- <th class="px-2 py-3 table-cell ">{{ __('Casino Lookup') }}</th> --}}
                        <th class="px-2 py-3 table-cell ">{{ __('Type') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Casino') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Group') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Deposit') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Bonus') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Balance') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Status') }}</th>
                        <th class="px-2 py-3 table-cell ">{{ __('Game Played') }}</th>
                        <th class="px-2 py-3 table-cell ">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody class="body table-row-group">
                    @foreach($casino_dones as $done)
                        <tr class="singleslot table-row px-6 py-2" data-done="{!! htmlspecialchars(json_encode($done)) !!}">
                            <td class="px-2 py-3 table-cell relative name">
                                <span>{{ $done->name }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell date">
                                <span>{{ $done->date }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell date">
                                <span>{{ $done->ipayment }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell date">
                                <span>{{ $done->ipaydate }}</span>
                            </td>
                            {{-- <td class="px-2 py-3  table-cell">{{ $done->bonus_lookup_casino_name }}</td> --}}
                            <td class="px-2 py-3  table-cell type">
                                <span>{{ $done->type }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell casino">
                                <span>{{ $done->casino_name }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell group">
                                <span>{{ $done->group }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell deposit">
                                <span>{{ $done->deposit }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell bonus">
                                <span>{{ $done->bonus }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell balance">
                                <span>{{ $done->balance }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell status">
                                <span>{{ $status_lists[$done->status] }}</span>
                            </td>
                            <td class="px-2 py-3  table-cell slot_name">
                                <span>{{ $done->slot_name }}</span>
                            </td>
                            
                            <td class="px-2 py-3 table-cell gap-1 action">
                                <div class="flex gap-2">
                                    <a data-url={{route('players.ajaxupdate', $done->id)}} href="{{route('players.edit', $done)}}" class="px-3 py-3 border pEdit rounded hover:text-gray-50 hover:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <form method="post" action="{{ route('players.destroy', $done) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="px-3 py-3 border rounded hover:text-gray-50 hover:bg-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @else
            <div class="alert px-6 py-3 bg-red-400 text-white mb-3 rounded">{{__('You have no permission to take any action on this page. Please contact to the site administrator to assign you as a worker.')}}</div>
        @endif
    </div>

   
@endsection