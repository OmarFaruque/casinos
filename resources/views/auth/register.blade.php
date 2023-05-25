@extends('layouts.app-master')

@section('content')
    <div class="flex justify-center h-100 content-center items-center min-h-screen">
        <div class="border p-10 rounded shadow-md w-2/5 center-center">
            <form method="post" action="{{ route('register.perform') }}">
                @csrf
                <h1 class="h3 text-2xl fw-normal text-center mb-6">Register</h1>
        
                <div class="form-group form-floating mb-3">
                    <input type="email" class="form-control block w-full rounded border p-2" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
                    <label for="floatingEmail"><small>Email address</small></label>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
        
                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control block w-full rounded border p-2" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                    <label for="floatingName"><small>Username</small></label>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                
                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control block w-full rounded border p-2" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                    <label for="floatingPassword"><small>Password</small></label>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
        
                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control block w-full rounded border p-2" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
                    <label for="floatingConfirmPassword"><small>Confirm Password</small></label>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
        
                <button class="w-8 bg-blue-100 p-2 mt-5" type="submit"><small>Register</small></button>
                
            </form>
        </div>
    </div>
    
@endsection