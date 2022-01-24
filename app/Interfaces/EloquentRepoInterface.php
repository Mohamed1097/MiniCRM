<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


interface EloquentRepoInterface
{
    public function paginate(int $perPage=15,array $columns=['*'],$pageName = 'page',array $relations=[]): LengthAwarePaginator;
    public function filter();
    public function getModel():? Model;
    public function findById(int $id,array $columns=['*'],array $relations=[],array $appends=[]):? Model;
    public function create(array $data):?Model;
    public function update(array $data,int $id): bool;
    public function delete(int $id): bool;
    public function count():int;
}