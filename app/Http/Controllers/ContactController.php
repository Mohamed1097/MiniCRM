<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactPerson;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message=null;
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
        $contacts=$contacts->paginate(10);
        if (!$contacts->count()) {
            $message='There No Contact';
        }
        return view('contacts.index',['title'=>'Contacts','contacts'=>$contacts,'message'=>$message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create',['title'=>'Add New Contact']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        ContactPerson::create($request->all());
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
        $contact=ContactPerson::findOrFail($id);
        $title='Edit '.$contact->full_name;
        return view('contacts.edit',['title'=>$title,'contact'=>$contact]);
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
        ContactPerson::findOrFail($id)->update($request->all());
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
        return ContactPerson::findOrFail($id)->delete($id) ? responseJson(1,'success') : responseJson(0,'There something Wrong Try Agian Later ');
        
    }
}
