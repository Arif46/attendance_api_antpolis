<?php

namespace App\LeadGeneration;

use Illuminate\Database\Eloquent\Model;

class LeadSubIndustry extends Model
{
    //
     public function lead_industry()
    {
        return $this->belongsTo('App\LeadGeneration\LeadIndustry');
    }
    public function product_or_services()
    {
        return $this->hasMany('App\LeadGeneration\LeadProductOrService');
    }
}
