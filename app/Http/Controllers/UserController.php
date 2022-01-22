<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message=null;

        return view('users.index',['title'=>'Users','users'=>User::paginate(10),'message'=>$message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create',['title'=>'Add New User']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->merge(['password'=>bcrypt($request->password)]);
        User::create($request->all());
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        $title='Edit '.$user->name;
        return view('users.edit',['title'=>$title,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user=User::findOrFail($id);
        if ($user->id!=auth()->user()->id) {
            $user->name=$request->name;
            $user->save();
            return redirect(route('users.index'));
        }
        $user->update($request->except('password'));
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id==auth()->user()->id) {
            return redirect(route('users.index'));
        }
        $user=User::findOrFail($id);
        return $user->delete() ? responseJson(1,'success',) : responseJson(0,'There SomeThing Wrong Try Again Later');
    }
    public function changePassword()
    {
        return view('users.set-new-password',['title'=>'Set New Password']);
    }
    public function setNewPassword(UserRequest $request)
    {
        $user=auth()->user();
        if(Hash::check($request->current_password,$user->password))
        {
            $user->password=bcrypt($request->password);
            $user->save();
            return redirect(route('change-password'))->withErrors(['message'=>'The Password Change Successfully']);
        }
        return redirect(route('change-password'))->withErrors(['current_password'=>'Your Current Password Is Wrong']);

    }
}
