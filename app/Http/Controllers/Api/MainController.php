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
        
        $companies=Company::paginate(10);
        if(!$companies->count())
        {
           return responseJson(0,'There IS No Companies Yet');
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
