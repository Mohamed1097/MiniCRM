<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Interfaces\CompanyRepoInterface;
use App\Mail\WelcomeNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    private $companyRepo;
    public function __construct(CompanyRepoInterface $companyRepo)
    {
        $this->companyRepo=$companyRepo;        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=$this->companyRepo->filter(); 
        $message=null;
        if (!count($companies)) {
            $message='There Is No Companies';
        }

        return view('companies.index',['title'=>'Companies','companies'=>$companies,'message'=>$message,'model'=>$this->companyRepo->getModel()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create',['title'=>'Add New Company','model'=>$this->companyRepo->getModel()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request){
        $path='logos/'.date('Y').'/'.date('M').'/'.date('d').'/';
        $logoName=$request->logo->hashName();
        $request->file('logo')->storeAs('public/'.$path,$logoName);
        $request->merge(['logo'=>$path.$logoName]);
        $company=$this->companyRepo->create($request->all());
        $this->companyRepo->saveLogo($path.$logoName,$company);
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
        $company=$this->companyRepo->findById($id);
        $contacts=$this->companyRepo->contacts($company);
        $message=null;
        if (!count($contacts)) {
            $message='There Is No Contacts';
            # code...
        }
        return view('companies.show',['title'=>$company->name,'company'=>$company,
        'contacts'=>$contacts,'message'=>$message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company=$this->companyRepo->findById($id);
        $title='Edit '.$company->name;
        return view('companies.edit',['title'=>$title,'company'=>$company,'model'=>$this->companyRepo->getModel()]);
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
        if($request->has('logo')){
            $company=$this->companyRepo->findById($id);
            $path='logos/'.date('Y').'/'.date('M').'/'.date('d').'/';
            $logoName=$request->logo->hashName();
            $request->file('logo')->storeAs('public/'.$path,$logoName);
            if (Storage::disk('public')->exists($company->logo)) {
                File::delete('storage/'.$company->logo);
            }
            $this->companyRepo->saveLogo($path.$logoName,$company);
        }
        $this->companyRepo->update($request->all(),$id);
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
        $company=$this->companyRepo->findById($id);
        if (Storage::disk('public')->exists($company->logo)) {
            File::delete('storage/'.$company->logo);
        }
        return $this->companyRepo->delete($id) ? responseJson(1,'success') : responseJson(0,'There Something Try Again Later');
    }
}
