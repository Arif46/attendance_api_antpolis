<?php

namespace App\LeadGeneration;

use Illuminate\Database\Eloquent\Model;

class LeadCompany extends Model
{
    //
    public function brands()
    {
        return $this->hasMany('App\LeadGeneration\LeadBrand');
    }
}
