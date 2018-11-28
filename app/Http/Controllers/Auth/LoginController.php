<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Models\Oauth\Oauth;

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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        $appNames = [];
        $oauths = Oauth::pluck('name');
        for($i = 0; $i < count($oauths); $i+=3){
            $appName = explode('_', $oauths[$i]);
            $appNames[] = $appName[0];
           
        }
        
        //if no user registration first.
        $user_count = User::count();
        if ($user_count == 0) {
            return redirect('register');
        }

        return view('auth.login', get_defined_vars());
    }
}
