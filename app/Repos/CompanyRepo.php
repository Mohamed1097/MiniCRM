<?php
namespace App\Repos;



use App\Interfaces\CompanyRepoInterface;
use App\Models\Company;

class CompanyRepo extends BaseRepo implements CompanyRepoInterface
{
    protected $model;
    public function __construct(Company $model)
    {
        $this->model=$model;
    }
   public function filter():array
   {
       $request=request();
       $model=$this->model;
       $message=null;
       if ($request->name) {
           $model=$model->where('name','like','%'.$request->name.'%');
       }
       if ($request->email) {
            $model=$model->where('email','like','%'.$request->email.'%');
       }
       if (!$model->count()) {
           $message='There No Result';
       }
       return ['companies'=>$model->paginate(10),'message'=>$message];
   }
   public function saveLogo(String $logo,Company $model):bool
   {
       $model->logo=$logo;
       return $model->save();
   }
   public function contacts(Company $model)
   {
    $message=null;
    $contacts=$model->contacts();
    if (!$contacts->count()) {
        $message='There Is No Contact';
    }
    return ['contacts'=>$contacts->paginate(10),'message'=>$message];
   }

}