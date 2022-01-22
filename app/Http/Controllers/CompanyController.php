<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Mail\WelcomeNotification;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message=null;
        $companies=new Company();
        if (request()->name) {
            $companies=$companies->where('name','like','%'.request()->name.'%');
        }
        if (request()->email) {
            $companies=$companies->where('email','like','%'.request()->email.'%');
        }
        $companies=$companies->paginate(10);
        if (!$companies->count()) {
            $message='There No Companies';
        }
        return view('companies.index',['title'=>'Companies','companies'=>$companies,'message'=>$message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create',['title'=>'Add New Company']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company=Company::create($request->all());
        $path='logos/'.date('Y').'/'.date('M').'/'.date('d').'/';
        $logoName=$request->logo->hashName();
        $request->file('logo')->storeAs('public/'.$path,$logoName);
        $company->logo=$path.$logoName;
        $company->save();
        Mail::to($company->email)->send(new WelcomeNotification($company->name));
        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company=Company::findOrFail($id);
        $message=null;
        $contacts=$company->contacts();
        if (!$contacts->count()) {
            $message='There Is No Contact';
        }
        $contacts=$contacts->paginate(1);
        return view('companies.show',['title'=>$company->name,'company'=>$company,'contacts'=>$contacts,'message'=>$message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company=Company::findOrfail($id);
        $title='Edit '.$company->name;
        return view('companies.edit',['title'=>$title,'company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company=Company::findOrFail($id);
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
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company=Company::findOrFail($id);
        if (Storage::disk('public')->exists($company->logo)) {
            File::delete('storage/'.$company->logo);
        }
        return $company->delete() ? responseJson(1,'success') : responseJson(0,'There Something Try Again Later');
    }
}
