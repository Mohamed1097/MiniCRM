<?php
namespace App\Repos;

use App\Interfaces\ContactRepoInterface;
use App\Models\ContactPerson;

class ContactRepo extends BaseRepo implements ContactRepoInterface
{
    protected $model;
    public function __construct(ContactPerson $model)
    {
        $this->model=$model;
    }
   public function filter():array
   {
       $request=request();
       $model=$this->model;
       $message=null;
       if ($request->first_name) {
           $model=$model->where('first_name','like','%'.$request->first_name.'%');
       }
       if ($request->last_name) {
            $model=$model->where('last_name','like','%'.$request->last_name.'%');
       }
       if ($request->email) {
        $model=$model->where('email','like','%'.$request->email.'%');
       }
       if ($request->phone) {
        $model=$model->where('phone','like','%'.$request->phone.'%');
       }
       if ($request->keyword) {
        $model=$model->whereHas('company',function($query) use ($request){
            $query->where('name','like','%'.$request->keyword.'%')->orWhere('email','like','%'.$request->keyword.'%');
        });
       }
       if (!$model->count()) {
           $message='There No Result';
       }
        return ['contacts'=>$model->with('company')->paginate(10),'message'=>$message];
   }

}