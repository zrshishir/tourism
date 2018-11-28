<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Oauth\Oauth;
use Session, Auth;
use Illuminate\Http\Request;
use App\Models\Activity\Activity;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest',  ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        $appNames = [];
        $oauths = Oauth::pluck('name');
        for($i = 0; $i < count($oauths); $i+=3){
            $appName = explode('_', $oauths[$i]);
            $appNames[] = $appName[0];
           
        }
        return view('auth.register', get_defined_vars());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $insertedData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => $data['status'],
        ];

        if (isset($data['role'])) {
            $insertedData['role'] = $data['role'];
        }
       
        $reg = User::create($insertedData);
        
        $totalUser = User::count();

        return $reg;
    }

    public function register(Request $request)
    {   
        $validator = $this->validator($request->all());

        // $misfitEmail = validateMisfitEmail($request->input('email'));
        // if(! $misfitEmail){
        //     Session::flash('login_error_msg', trans('common.misfit_email'));
        //     return redirect('register');
        // }

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $allRequest = $request->all();
        $allRequest['status'] = 'Active';

        // for super admin account
        $usersCount = User::count();
        if ($usersCount == 0) {
            $allRequest['role'] = 'superadmin';
        } else {
            $allRequest['role'] = 'user';
        }
        // dd($request);
        //save into database ,auto login
        Auth::login($this->create($allRequest));

        $user_id = Auth::id();
        $message = 'Logged in.';
        // save information  into activity table
        Activity::saveActivity($user_id, $message);

        return redirect('/');
    }

    public function postRegister(Request $request)
    {
       
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $allRequest = $request->all();
        $allRequest['status'] = 'Active';

        // for admin account
        $usersCount = User::count();
        if ($usersCount == 0) {
            $allRequest['role'] = 'admin';
        }

        //save into database ,auto login
        Auth::login($this->create($allRequest));

        $user_id = Auth::id();
        $message = 'Logged in.';
        // save information  into activity table
        Activity::saveActivity($user_id, $message);
        // return redirect('/');
        return redirect($this->redirectPath());
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // checked banned user if true redirect to login with message
            if (Auth::user()->status == 'Banned') {
                Auth::logout();
                Session::flash('login_error_msg', trans('common.banned_msg'));
                return redirect('/login');
            }

            $user_id = Auth::id();
            $message = 'Logged in.';
            // save information  into activity table
            Activity::saveActivity($user_id, $message);

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    public function getLogout()
    {
        $user_id = Auth::id();
        $message = 'Logged out.';
        // save information  into activity table
        Activity::saveActivity($user_id, $message);

        //logout
        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
