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
   public function filter()
   {
       $request=request();
       $model=$this->model;
       if ($request->name) {
           $model=$model->where('name','like','%'.$request->name.'%');
       }
       if ($request->email) {
            $model=$model->where('email','like','%'.$request->email.'%');
       }
       return $model->paginate(10);
   }
   public function saveLogo(String $logo,Company $model):bool
   {
       $model->logo=$logo;
       return $model->save();
   }
   public function contacts(Company $model)
   {
    $contacts=$model->contacts();
    return $contacts->paginate(10);
   }

}