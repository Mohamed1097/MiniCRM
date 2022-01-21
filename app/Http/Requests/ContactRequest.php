<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
    protected function onCreate()
    {
        return [
            'first_name'=>'required|min:2',
            'last_name'=>'required|min:2',
            'company_id'=>'required|exists:companies,id',
            'email'=>'required|email:rfc,dns|unique:contact_persons,email',
            'phone'=>'required|starts_with:010,011,012,015|regex:/(01)[0-9]{9}/|digits:11|unique:contact_persons,phone',
            'linkdin_profile_url'=>'url|unique:contact_persons,linkdin_profile_url',
        ];
    }
    protected function onUpdate()
    {
        return [
            'id'=>'required|exists:contact_persons,id',
            'first_name'=>'required|min:2',
            'last_name'=>'required|min:2',
            'company_id'=>'required|exists:companies,id',
            'email'=>'required|email:rfc,dns|unique:contact_persons,email,'.request()->id,
            'phone'=>'required|starts_with:010,011,012,015|regex:/(01)[0-9]{9}/|digits:11|unique:contact_persons,phone,'.request()->id,
            'linkdin_profile_url'=>'url|unique:contact_persons,linkdin_profile_url,'.request()->id,
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return request()->routeIs('contacts.store') ? $this->onCreate() : $this->onUpdate();
    }
    public function messages()
    {

        return [
            'id.required'=>'The ID Of The Contact Is Required',
            'id.exists'=>'The ID Of The Contact Is Invalid',
            'first_name.required'=>'The First Name Is Required',
            'first_name.min'=>'The First Name Should Conatains At Least 2 Chars',
            'last_name.required'=>'The Last Name Is Required',
            'last_name.min'=>'The Last Name Should Conatains At Least 2 Chars',
            'company_id.required'=>'The Company Is Required',
            'Company_id.exists'=>'The Selected Company Is Invalid',
            'email.required'=>'The Email Is Required',
            'email.email'=>'The Email Is Invalid',
            'email.unique'=>'There Another Contact Use That Email',
            'phone.required'=>'The Phone Is Required',
            'phone.starts_with'=>'The Phone Is Invalid',
            'phone.regex'=>'The Phone Is Invalid',
            'phone.digits'=>'The Phone Is Invalid',
            'phone.unique'=>'There Is Another Contact Use This Phone',
            'linkdin_profile_url.url'=>'This Url Is Invalid',
            'linkdin_profile_url.unique'=>'This Profile Is Used By Another Contact',
        ];
    }
}
