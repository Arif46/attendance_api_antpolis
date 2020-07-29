<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
     public function sub_department(){
        return $this->belongsTo(SubDepartment::class);
    }
   
}
