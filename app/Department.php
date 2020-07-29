<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    // protected $table = 'departments';

     public function company()
    {
        return $this->belongsTo('App\Company');
    }
    public function SubDepartments(){
        return $this->hasMany(SubDepartment::class);
    }
}
