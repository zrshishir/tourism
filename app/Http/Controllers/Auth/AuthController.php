<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Collection;
use App\User;

use Socialite;
use Log;

class AuthController extends Controller
{


    public $requestPath;
    protected $redirectTo = '/home';

    public function __construct(Request $request){
        $this->requestPath = $request->path();
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function redirectToProvider(){
        Log::info($this->requestPath);
        return Socialite::driver($this->requestPath)->redirect();
    }

    public function handleProviderCallback(Request $request){
        $driver = explode('/', $this->requestPath);
        $driverName = $driver[0];

        $user = Socialite::driver($driverName)->user(); //making an object for retrieving data

        $email = $user->getEmail(); 

        if(User::count() == 0){
            $insertedData = [
                'name' => $user->getName(),
                'email' => $email,
                'status' => 'Active',
                'platform' => $driverName,
                'oauth_user_id' => $user->getId(),
                'photo' => $user->getAvatar(),
                'role' => 'superadmin'
            ];
        }
        $id = User::where('email', $email)->pluck('id');
        Log::alert($id[0]);
        
        if($id->isEmpty()){
            $insertedData = [
                'name' => $user->getName(),
                'email' => $email,
                'status' => 'Active',
                'platform' => $driverName,
                'oauth_user_id' => $user->getId(),
                'photo' => $user->getAvatar(),
            ];    

            Auth::login(User::create($insertedData));
            return redirect()->intended('/home');
        }

        Auth::login(User::find($id[0]));
        return redirect()->intended('/home');
    }
}
