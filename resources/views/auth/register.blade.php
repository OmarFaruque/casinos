@extends('layouts.app-master')

@section('content')
    <div class="flex justify-center h-100 content-center items-center min-h-screen mx-auto w-4/6">
        <div class="border p-10 rounded shadow-md w-2/5 center-center">
            <form method="post" 
                @if(Route::is('register.show'))
                    action="{{route('register.perform')}}"
                @else 
                    action="{{route('register.update', $user)}}"
                @endif   
                >
                @if(!Route::is('register.show'))
                    @method('PATCH')
                @endif
                @csrf
                <h1 class="h3 text-2xl fw-normal text-center mb-6">{{ Route::is('register.show') ? __('Register New User') : __('Update User Information')}}</h1>
        
                <div class="form-group form-floating mb-3">
                    <input type="email" {{ isset($user) ? 'disabled' : '' }} class="form-control block w-full rounded border p-2" name="email" value="{{ isset($user) && $user->email ? $user->email : old('email') }}" placeholder="name@example.com" required="required" autofocus>
                    <label for="floatingEmail"><small>{{__('Email address')}}</small></label>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
        
                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control block w-full rounded border p-2" name="username" value="{{ isset($user) && $user->name ? $user->name : old('username') }}" placeholder="Username" required="required" autofocus>
                    <label for="floatingName"><small>Username</small></label>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                
                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control block w-full rounded border p-2" name="display_name" value="{{ isset($user) && $user->display_name ? $user->display_name : old('display_name') }}" placeholder="Name.." required="required" autofocus>
                    <label for="floatingName"><small>{{__('Display name')}}</small></label>
                    @if ($errors->has('display_name'))
                        <span class="text-danger text-left">{{ $errors->first('display_name') }}</span>
                    @endif
                </div>
                <div class="form-group form-floating mb-3">
                    <select name="role" id="user_role" class="border rounded p-2 mr-2 w-full shadow">
                        <option value="">{{__('User...')}}</option>
                        @foreach($roles  as $k => $role)
                            <option {{ isset($user) && $user->role == $k ? 'selected' : '' }} value="{{$k}}">{{ $role }}</option>
                        @endforeach
                    </select>
                    <label for="user_role"><small>{{__('Role')}}</small></label>
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control block w-full rounded border p-2" name="password" value="" autocomplete="new-password" placeholder="Password" {{Route::is('register.show') ? 'required="required"': ''}}>
                    <label for="floatingPassword"><small>Password</small></label>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                @if(Route::is('register.show'))
                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control block w-full rounded border p-2" name="password_confirmation" value="" placeholder="Confirm Password" {{Route::is('register.show') ? 'required="required"': ''}}>
                    <label for="floatingConfirmPassword"><small>{{__('Confirm Password')}}</small></label>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                @endif
        
                <button class="w-8 bg-blue-100 p-2 mt-5" type="submit"><small>{{Route::is('register.show') ? __('Register') : __('Update')}}</small></button>
                
            </form>
        </div>
    </div>
    
@endsection