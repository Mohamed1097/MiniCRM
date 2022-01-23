<?php
namespace App\Repos;

use App\Models\User;
use App\Interfaces\UserRepoInterface;

class UserRepo extends BaseRepo implements UserRepoInterface
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model=$model;
    }
    
}