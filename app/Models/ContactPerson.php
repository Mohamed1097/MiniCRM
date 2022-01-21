<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model 
{

    protected $table = 'contact_persons';
    public $timestamps = true;
    protected $fillable = array('first_name', 'last_name', 'company_id', 'email', 'phone', 'linkdin_profile_url');

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

}