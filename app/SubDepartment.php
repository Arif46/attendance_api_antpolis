<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    //
     public function department(){
        return $this->belongsTo(Department::class);
    }
    public function designations(){
        return $this->hasMany(Designation::class);
    }
   
	 public function DepDetails()
    {
        return $this->belongsTo(Department::class, Company::class);
    }
}
