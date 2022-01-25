<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    protected function onLogin()
    {
        return [
            'email'=>'required',
            'password'=>'required'
        ];
    }
    protected function onCreate()
    {
        
        return [
            'name'=>'required|min:2',
            'email'=>'required|email:rfc,dns|unique:users,email',
            'password'=>'required|min:8|confirmed'
        ];
    }
    protected function onUpdate()
    {
        if (request()->user()->id==request()->id) {
            return [
                'id'=>'required|exists:users,id',
                'name'=>'required|min:2',
                'email'=>'required|email:rfc,dns|unique:users,email,'.request()->id,
            ];
        }
        return [
            'id'=>'required|exists:users,id',
            'name'=>'required|min:2',
        ];
        
       
    }
    protected function onSetNewPassword()
    {
        return
        [
            'current_password'=>'required',
            'password'=>'required|min:8|confirmed',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->routeIs('login')) {
            return $this->onLogin();
        }
        if (request()->routeIs('users.store')) {
            return $this->onCreate();
        }
        if (request()->routeIs('users.update')) {
            return $this->onUpdate();
        }
        if (request()->routeIs('set-new-password')) {
            return $this->onSetNewPassword();
        }
    }
    public function messages()
    {
        return [
            'current_password.required'=>'Current Passward Is Required',
            'id.required'=>'The ID Of The User Id Required',
            'id.exists'=>'The ID Is Invalid',
            'email.required'=>'The Email Is Required',
            'email.email'=>'The Email Is Invalid',
            'email.unique'=>'There Is Another Admin With That Email',
            'password.required'=>'The Password Is Required',
            'password.min'=>'The Password Is At Least Contains 8 Chars',
        ];
    }
}
