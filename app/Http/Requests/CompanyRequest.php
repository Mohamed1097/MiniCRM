<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name'=>'required|min:2|unique:companies,name',
            'email'=>'required|email:rfc,dns|unique:companies,email',
            'logo'=>'required|image|mimes:jpg,png,jpeg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website_url'=>'required|url|unique:companies,website_url'
        ];
    }
    protected function onUpdate()
    {
        return [
            'id'=>'required|exists:companies,id',
            'name'=>'required|min:2|unique:companies,name,'.request()->id,
            'email'=>'required|email:rfc,dns|unique:companies,email,'.request()->id,
            'logo'=>'image|mimes:jpg,png,jpeg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website_url'=>'required|url|unique:companies,website_url,'.request()->id
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return request()->routeIs('companies.store') ? $this->onCreate() : $this->onUpdate();
    }
    public function messages()
    {
        return[
            'id.required'=>'The ID OF The company Is Required',
            'id.exists'=>'The ID Is Invalid',
            'name.required'=>'The Name  Of The Campany Is Required',
            'name.min'=>'The Name Should At Least Two Chars',
            'name.unique'=>'There Is Another Comapny With That Name',
            'email.required'=>'The Email Of The Company Is Required',
            'email.email'=>'The Email Is Invalid',
            'email.unique'=>'There Is Another Company With That Email',
            'logo.required'=>'The Logo Is Required',
            'logo.image'=>'The Logo Should Be Image',
            'logo.mimes'=>'The Logo extension Should be jpg , png , jpeg  Or gif',
            'logo.max'=>'The Maximum Size Of The Logo 2 MB',
            'logo.dimensions'=>'The Min Width Is 100 px and The Min Height Is 100 px',
            'website_url.required'=>'The Website Of The Company Is Required',
            'website_url.url'=>'The Website Url Is Invalid',
            'website_url.unique'=>'This Website Is Used By Another Comapany'
        ];
    }
}
