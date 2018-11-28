<?php

namespace App\Http\Controllers\Apprequest;


use App\Models\Apprequest\Apprequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Oauth\Oauth;
use Session, Auth;
use Illuminate\Http\Request;
use App\Models\Activity\Activity;
use App\Models\Department\Department;
use App\Http\Requests\Users\UsersRequest;

class ApprequestController extends Controller
{

    public function index()
   {
        $title = trans('common.request');
        if(Auth::user()->role != 'user'){
            $allRequests = Apprequest::get();
        }else{
            $allRequests = Apprequest::where('user_id', Auth::user()->id)->get();
        }
      

        $pageName = trans('common.all') . ' ' . trans('common.request');
        return view('apprequest.home', get_defined_vars());
    }

    // add new user
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $insertedData = $request->all();
        $insertedData['user_id'] = $userId;
        $insertedData['status'] = 0;
       
        if(Auth::user()->role == 'user'){
            $status = Apprequest::create($insertedData);
        }
       
        
        if($status){
            $user_id = Auth::id();
            $message = 'Created user ' . Auth::user()->email;
            //save into activity
            Activity::saveActivity($user_id, $message);
            Session::flash('success_msg', 'Successfully created a Apprequest.');
        }
       

        return redirect('apprequest');
    }

    
    public function change_status($requestId)
    {
        // get user by user_id
        $user = Apprequest::find($requestId);

        if(Auth::user()->role != 'user'){
            if ($user->status == 0) {// check user status (Active, Banned) and set
                $user->status = 1;
            } else if ($user->status == 1) {
                $user->status = 2;
            }
            $user->save();
            $message = $user->status . ' user ' . Auth::user()->email;
            Activity::saveActivity(Auth::id(), $message);
        }
        
        return redirect('apprequest');
    }


}
