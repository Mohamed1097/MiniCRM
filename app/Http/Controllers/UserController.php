<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserRepoInterface;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $userRepo;
    public function __construct(UserRepoInterface $userRepo){
        $this->userRepo=$userRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message=null;
        return view('users.index',['title'=>'Users','users'=>$this->userRepo->paginate(10),'message'=>$message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create',['title'=>'Add New User','model'=>$this->userRepo->getModel()]);
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
        $this->userRepo->create($request->all());
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
        $user=$this->userRepo->findById($id);
        $title='Edit '.$user->name;
        return view('users.edit',['title'=>$title,'user'=>$user,'model'=>$this->userRepo->getModel()]);
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
        if ($id!=auth()->user()->id) {
            $this->userRepo->update(['name'=>$request->name],$id);
            return redirect(route('users.index'));
        }
        $this->userRepo->update($request->except('password'),$id);
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
        return $this->userRepo->delete($id) ? responseJson(1,'success',) : responseJson(0,'There SomeThing Wrong Try Again Later');
    }
    public function changePassword()
    {
        return view('users.set-new-password',['title'=>'Set New Password','model'=>$this->userRepo->getModel()]);
    }
    public function setNewPassword(UserRequest $request)
    {
        $user=auth()->user();
        if(Hash::check($request->current_password,$user->password))
        { 
            return $this->userRepo->update(['password'=>bcrypt($request->password)],$user->id) ?
             redirect(route('change-password'))->withErrors(['message'=>'The Password Change Successfully']) :
             redirect(route('change-password'))->withErrors(['message'=>'There Is Something Wrong Try Again Later']); 
        }
        return redirect(route('change-password'))->withErrors(['current_password'=>'Your Current Password Is Wrong']);
    }
}
