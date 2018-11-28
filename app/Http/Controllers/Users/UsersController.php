<?php

namespace App\Http\Controllers\Users;


use App\User;
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

class UsersController extends Controller
{

    public function index()
   {
        $title = trans('common.add') . ' ' . trans('common.user');
        $allUsers = User::get();
        $departments = Department::pluck('name', 'name'); 

        $pageName = trans('common.all') . ' ' . trans('common.users');
        return view('users.home', get_defined_vars());
    }

    // add new user
    public function store(Request $request, User $user)
    {
        $validator = $this->validator($request->all());

        $misfitEmail = validateMisfitEmail($request->input('email'));

        if(! $misfitEmail){
            Session::flash('error_msg', trans('common.misfit_email'));
            return redirect('users');
        }

        
        $allRequest = $request->all();
        $allRequest['status'] = 'Active';

        $insertedData = [
            'name' => $allRequest['name'],
            'email' => $allRequest['email'],
            'password' => bcrypt($allRequest['password']),
            'status' => $allRequest['status'],
            'role' => $allRequest['role']
        ];

        // dd($request);
        //save into database ,auto login
        $status = User::create($insertedData);

        if($status){
            $user_id = Auth::id();
            $message = 'Created user ' . $user->email;
            //save into activity
            Activity::saveActivity($user_id, $message);
            Session::flash('success_msg', 'Successfully created a User.');
        }
       

        return redirect('users');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    

    public function edit(User $user)
    {
        //get all user
        
            $allUsers = User::where('role', 'user')->get();
       
            $departments = Department::pluck('name', 'name');
        
        $userInfo = $user;
        $title = trans('common.edit') . ' ' . trans('common.user');

        return view('users.home', get_defined_vars());

    }

    public function update(UsersRequest $request, User $user)
    {
        //updated user info
        $data['name'] = $request->name;

        $misfitEmail = validateMisfitEmail($request->email);

        if(! $misfitEmail){
            Session::flash('error_msg', trans('common.misfit_email'));
            return redirect('users');
        }

        if($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        if ($request->email != $user->email) {
            $data['email'] = $request->email;
        }

       if($request->role != $user->role){
           $data['role'] = $request->role;
       }
        $user->save();

        $user->update($data);

        $user_id = Auth::id();
        $message = 'Updated user ' . $user->email;
        Activity::saveActivity($user_id, $message);

        Session::flash('success_msg', 'Successfully Updated User.');
        return redirect('users');

    }

    public function destroy(User $user)
    {
        //deleted user
        $user_id = Auth::id();
        $message = 'Deleted user ' . $user->email;
        Activity::saveActivity($user_id, $message);

        // deleted all activity according to this user
        Activity::where('user_id', $user->id)->delete();

        $user->delete();

        Session::flash('success_msg', 'Successfully Deleted User.');
        return redirect('users');
    }

    public function change_status($user_id)
    {
        // get user by user_id
        $user = User::find($user_id);

        if ($user->status == 'Active') {// check user status (Active, Banned) and set
            $user->status = 'Banned';
        } else if ($user->status == 'Banned') {
            $user->status = 'Active';
        }
        $user->save();
        $message = $user->status . ' user ' . $user->email;
        Activity::saveActivity(Auth::id(), $message);
        return redirect('users');
    }


}
