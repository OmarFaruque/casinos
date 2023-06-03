@extends('layouts.app-master')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="bg-light rounded w-full">
        @guest
            @include('layouts.partials.login')
        @endguest

        @auth
            <div class="wrap min-w-full">
                <div class="grid grid-cols-1 p-10 gap-10">
                    <div class="w-full rounded shadow-md px-8 py-10 bg-slate-100">
                        <h1 class="text-2xl">{{__('Profit & EV')}}</h1>
                        <canvas class="w-full" id="profitChart" data-profits={{$profits}}></canvas>
                    </div>  
                </div>
            </div>
        @endauth

    </div>
@endsection