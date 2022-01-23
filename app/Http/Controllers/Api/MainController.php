<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ContactRequest;
use App\Interfaces\CompanyRepoInterface;
use App\Interfaces\ContactRepoInterface;
use App\Mail\WelcomeNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    private $companyRepo,$contactRepo;
    public function __construct(CompanyRepoInterface $companyRepo,ContactRepoInterface $contactRepo)
    {
        $this->companyRepo=$companyRepo;
        $this->contactRepo=$contactRepo;
    }
    public function companies()
    { 
        $companies=$this->companyRepo->filter();
        if($companies['message'])
        {
           return responseJson(0,$companies['message']);
        }
        return responseJson(1,'success',$companies['companies']);
    }
    public function addCompany(CompanyRequest $request)
    {
        $path='logos/'.date('Y').'/'.date('M').'/'.date('d').'/';
        $logoName=$request->logo->hashName();
        $company=$this->companyRepo->create($request->all());
        $request->file('logo')->storeAs('public/'.$path,$logoName);
        $this->companyRepo->saveLogo($path.$logoName,$company);
        Mail::to($company->email)->send(new WelcomeNotification($company->name));
        return responseJson(1,'success',['company'=>$company]); 
    }
    public function editCompany(CompanyRequest $request)
    {
        $company=$this->companyRepo->findById($request->id);
        if($request->has('logo'))
        {
            $path='logos/'.date('Y').'/'.date('M').'/'.date('d').'/';
            if (Storage::disk('public')->exists($company->logo)) {
                File::delete('storage/'.$company->logo);
            }
            $logoName=$request->logo->hashName();
            $request->file('logo')->storeAs('public/'.$path,$logoName);
            $this->companyRepo->saveLogo($path.$logoName,$company);
        }
        return $this->companyRepo->update($request->all(),$request->id) ?
         responseJson(1,'success',['company'=>$this->companyRepo->findById($request->id)]) : responseJson(0,'failed');
    }
    public function contacts()
    {
        $contacts=$this->contactRepo->filter();
        if($contacts['message'])
        {
           return responseJson(0,$contacts['message']);
        }
        return responseJson(1,'success',['contacts'=>$contacts['contacts']]);
    }
    public function addContact(ContactRequest $request)
    {
        $contact=$this->contactRepo->create($request->all());
        return responseJson(1,'success',['contact'=>$contact]);
    }
    public function editContact(ContactRequest $request)
    {
        return $this->contactRepo->update($request->all(),$request->id) ? responseJson(1,'success',['contact'=>$this->contactRepo->findById($request->id)]) :
         responseJson(0,'Failed');
    }
}
