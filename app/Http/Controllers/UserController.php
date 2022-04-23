<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Auth as Auths;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function login_page(){
        return view('/login');
    }
    public function register_page(){
        return view('/register');
    }
    public function register_verification(Request $request) {
        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'email'=>'required'
        ]);
        $values = array(
            'name' => $request->name,
            'password'=> Hash::make($request->password),
            'email' => $request->email
        );
        User::create($values);
        $values = array(
            'user_id' => User::where('name', $request->name)->first()->id,
            'authentication' => 0
        );
        Auths::create($values);
        return view('/login');
    }
    public function home(){
        return view('/home');
    }
    function verification(Request $request)
    {
        $this->validate($request, [
            'name'   => ['required'],
            'password'  => ['required','min:3']
        ]);
        $user = array(
            'name' => $request->get('name'),
            'password' => $request->get('password')
        );
        if(Auth::attempt($user))
        {
            return redirect('/home');
        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

}
