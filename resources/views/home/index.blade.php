@extends('layouts.app-master')

@section('content')
    <div class="bg-light rounded">

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection