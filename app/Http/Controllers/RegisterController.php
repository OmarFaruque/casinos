<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{


    /**
     * List of all users
     */
    public function index(){
        $users = User::all();
        return view('auth.lists')
                ->with(['users' => $users]);
    }

    /** 
     * Array of user roles
     * 
     * @return array
     */
    protected function roles(){
        return array(
            'administrator' => 'Administrator', 
            'manager' => 'Manager', 
            'staff' => 'Staff'
        );
    }

    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register')->with([
            'roles' => $this->roles()
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('auth.register')->with([
            'user' => $user, 
            'roles' => $this->roles()
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user)
    {
        $user = User::find($user);
        $user->role = $request->role; 
        $user->name = $request->username;
        $user->display_name = $request->display_name; 
        if(!empty($request->password))
            $user->password = $request->password;
              
        $user->update();
        

        return redirect('userlists')->with('success','Updated successfully');   
    }
    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $user = array();
        $user['name'] = $request->username;
        $user['email'] = $request->email;
        $user['password'] = $request->password;
        $user['password_confirmation'] = $request->password_confirmation;
        $user['role'] = $request->role;
        $user['display_name'] = $request->display_name;

        // dd($user);
        $user = User::create($user);

        // auth()->login($user);

        return redirect('userlists')->with('success', "Account successfully registered.");
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('userlists')->with('success','Delete user successfully');
    }
}
