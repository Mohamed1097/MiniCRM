<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model 
{

    protected $table = 'companies';
    public $timestamps = true;
    protected $fillable = array('name', 'email','website_url');

    public function contacts(){
        return $this->hasMany('App\Models\ContactPerson');
    }

}