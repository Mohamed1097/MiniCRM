<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Interfaces\CompanyRepoInterface;
use App\Interfaces\ContactRepoInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactRepo,$companyRepo;
    public function __construct(ContactRepoInterface $contactRepo,CompanyRepoInterface $companyRepo)
    {
        $this->contactRepo=$contactRepo;
        $this->companyRepo=$companyRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts=$this->contactRepo->filter();
        $message=null;
        if (!count($contacts)) {
            $message='There Is No Contacts';
        }
        return view('contacts.index',['title'=>'Contacts','contacts'=>$contacts,'message'=>$message,'model'=>$this->contactRepo->getModel()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create',['title'=>'Add New Contact','model'=>$this->contactRepo->getModel(),'companies'=>$this->companyRepo->getModel()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $this->contactRepo->create($request->all());
        return redirect()->route('contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact=$this->contactRepo->findById($id);
        $title='Edit '.$contact->full_name;
        return view('contacts.edit',['title'=>$title,'contact'=>$contact,'model'=>$this->contactRepo->getModel(),'companies'=>$this->companyRepo->getModel()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->contactRepo->update($request->all(),$id);
        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->contactRepo->delete($id) ? responseJson(1,'success') : responseJson(0,'There something Wrong Try Agian Later ');
        
    }
}
