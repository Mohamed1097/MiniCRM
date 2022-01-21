<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ContactRequest;
use App\Models\Company;
use App\Models\ContactPerson;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function companies()
    {
        
        $companies=new Company();
        if (request()->name) {
            $companies=$companies->where('name','like','%'.request()->name.'%');
        }
        if (request()->email) {
            $companies=$companies->where('email','like','%'.request()->email.'%');
        }
        $companies=$companies->paginate(10);
        if(!$companies->count())
        {
           return responseJson(0,'There IS No Companies');
        }
        return responseJson(1,'success',$companies);
    }
    public function addCompany(CompanyRequest $request)
    {
        
        $path='logos/'.date('Y').'/'.date('M').'/'.date('d').'/';
        $logoName=$request->logo->hashName();
        $company=Company::create($request->all());
        $request->file('logo')->storeAs('public/'.$path,$logoName);
        $company->logo=$path.$logoName;
        $company->save();
        return responseJson(1,'success',['company'=>$company]);
         
    }
    public function editCompany(CompanyRequest $request)
    {
       
        $company=Company::find($request->id);
        if($request->has('logo'))
        {
            $path='logos/'.date('Y').'/'.date('M').'/'.date('d').'/';
            if (Storage::disk('public')->exists($company->logo)) {
                File::delete('storage/'.$company->logo);
            }
            $logoName=$request->logo->hashName();
            $request->file('logo')->storeAs('public/'.$path,$logoName);
            $company->logo=$path.$logoName;
            $company->save();
        }
        $company->update($request->all());
        return responseJson(1,'success',['company'=>$company]);
    }
    public function contacts()
    {
        $contacts=new ContactPerson();
        if (request()->first_name) {
            $contacts=$contacts->where('first_name','like','%'.request()->first_name.'%');
        }
        if (request()->last_name) {
            $contacts=$contacts->where('last_name','like','%'.request()->last_name.'%');
        }
        if (request()->email) {
            $contacts=$contacts->where('email','like','%'.request()->email.'%');
        }
        if (request()->phone) {
            $contacts=$contacts->where('phone','like','%'.request()->phone.'%');
        }
        if (request()->keyword) {
            $contacts=$contacts->whereHas('company',function($query){
                $query->where('name','like','%'.request()->keyword.'%')->orWhere('email','like','%'.request()->keyword.'%');
            });
        }
        if(!$contacts->count())
        {
           return responseJson(0,'There IS No Contacts');
        }
        $contacts=$contacts->with('company')->paginate(10);
        return responseJson(1,'success',['contacts'=>$contacts]);
    }
    public function addContact(ContactRequest $request)
    {
        $contact=ContactPerson::create($request->all());
        return responseJson(1,'success',['contact'=>$contact]);
    }
    public function editContact(ContactRequest $request)
    {
        $contact=ContactPerson::find($request->id);
        $contact->update($request->all());
        return responseJson(1,'success',['contact'=>$contact]);
    }
}
