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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return request()->routeIs('login') ? $this->onLogin() : $this->onCreate();
    }
    public function messages()
    {
        return [
            'email.required'=>'The Email Is Required',
            'email.email'=>'The Email Is Invalid',
            'email.unique'=>'There Is Another Admin With That Email',
            'password.required'=>'The Password Is Required',
            'password.min'=>'The Password Is At Least Contains 8 Chars'
        ];
    }
}
