<?php

namespace App\LeadGeneration;

use Illuminate\Database\Eloquent\Model;

class LeadBrandService extends Model
{
    //
    public function lead_brand()
    {
        return $this->belongsTo('App\LeadGeneration\LeadBrand');
    } 
    public function lead_product_or_service()
    {
        return $this->belongsTo('App\LeadGeneration\LeadProductOrService');
    }
}
