<?php

namespace App\Repos;

use App\Interfaces\EloquentRepoInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepo implements EloquentRepoInterface
{
    protected $model;
    public function __construct($model)
    {
        $this->model=$model;
    }
    public function paginate(int $perPage=15,array $columns=['*'], $pageName = 'page',array $relations=[]): LengthAwarePaginator {
        return $this->model->with($relations)->paginate($perPage,$columns,$pageName);
    }
    public function findById(int $id,array $columns=['*'],array $relations=[],array $appends=[]):? Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($id)->append($appends);
    }
    public function create(array $data):?Model{
        return $this->model->create($data);
    }
    public function update(array $data,int $id): bool{
        return $this->model->findOrFail($id)->update($data);
    }
    public function delete(int $id): bool{
        return $this->model->findOrFail($id)->delete();
    }
    public function count():int{
        return $this->model->count();
    }
    public function filter():array
    {
        return [];
    }

}