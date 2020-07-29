<?php

namespace App\LeadGeneration;

use Illuminate\Database\Eloquent\Model;

class LeadProductOrService extends Model
{
    //
      public function lead_sub_industry()
    {
        return $this->belongsTo('App\LeadGeneration\LeadSubIndustry');
    }  
    public function brand_services()
    {
        return $this->belongsTo('App\LeadGeneration\LeadBrandService');
    }
}
