<?php
namespace App\Interfaces;

use App\Models\Company;

interface CompanyRepoInterface extends EloquentRepoInterface
{
    public function saveLogo(String $logo,Company $model):bool;
    public function contacts(Company $model);

}