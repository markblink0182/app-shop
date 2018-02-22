<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as IlluminateRequest;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//Metodo que se va sobre escribir, es copia de Authenticatesuser.php
//
    public function username()
    {
        return 'username';
    }

    public function showLoginForm(IlluminateRequest $request)
    {
        if($request->has('redirect_to'))
        {
            session()->put('redirect_to', $request->input('redirect_to'));
        }
        return view('auth.login');
    }

    public function redirectTo()
    {
        if(session()->has('redirect_to'))
        {
            return session()->pull('redirect_to'); //pull obtenemos el valor de la variable e eliminamos la existencia de dicha variable
            return $this->redirectTo;
        }
    }
}
