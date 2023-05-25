@extends('layouts.app-master')

@section('content')
   <div class="grid justify-center h-100 content-center min-h-screen">
    <div class="border p-10 rounded shadow-md">
        <form method="post" action="{{ route('login.perform') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <h1 class="h3 text-2xl fw-normal text-center mb-6">Login</h1>
    
            @include('layouts.partials.messages')
    
            <div class="form-group form-floating mb-6">
                <input type="text" class="rounded w-full p-2 border block" name="email" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                <label for="floatingName" class="text-gray"><small><i>Email or Username</i></small></label>
                @if ($errors->has('username'))
                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>
            
            <div class="form-group form-floating mb-3">
                <input type="password" class="rounded w-full p-2 border" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                <label for="floatingPassword"><small><i>Password</i></small></label>
                @if ($errors->has('password'))
                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                @endif
            </div>
    
            <button class="w-8 bg-blue-100 p-2 mt-5" type="submit">Login</button>
            
        </form>
    </div>
   </div>
@endsection