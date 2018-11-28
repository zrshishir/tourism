<?php

namespace App\Http\Requests\Users;

use Auth;
use App\Http\Requests\Request;
use App\User;
use Log;

class UsersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $user = User::find($this->segment(2));
        if ($user) {

            if ($user->email == $this->email) {
                $rules = [
                    'name' => 'required',
                ];
            } else {
                $rules = [
                    'name' => 'required',
                    'email' => 'required|email|max:255|unique:users',
                ];
            }

            if ($this->has('password') || $this->has('confirm_password')) {
                $rules['password'] = 'required';
                $rules['confirm_password'] = 'required|same:password';
            }

            if (Auth::user()->role == 'superadmin') {
                if($this->has('customers_user')) {
                    $rules['customer_id'] = 'required';
                }
            }
            return $rules;
        }
        $rules = [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];

        if (Auth::user()->role == 'superadmin') {
            if($this->has('customers_user')) {
                $rules['customer_id'] = 'required';
            }
        }

        return $rules;
    }
}
