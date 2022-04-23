<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function login_page(){
        return view('/login');
    }
    public function home(){
        $user = User::find(Auth::id());
        return view('/home', ['user' => $user]);
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
