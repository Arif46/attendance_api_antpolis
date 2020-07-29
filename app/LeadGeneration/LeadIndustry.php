<?php

namespace App\LeadGeneration;

use Illuminate\Database\Eloquent\Model;

class LeadIndustry extends Model
{
    //
    public function sub_industries()
    {
        return $this->hasMany('App\LeadGeneration\LeadSubIndustry');
    } 
    
}
