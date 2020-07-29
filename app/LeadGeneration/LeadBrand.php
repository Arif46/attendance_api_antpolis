<?php

namespace App\LeadGeneration;

use Illuminate\Database\Eloquent\Model;

class LeadBrand extends Model
{
    //
    //  public function company()
    // {
    //     return $this->belongsTo('App\LeadGeneration\LeadCompany');

    // }
    // lead_company and without this naming belongs to doesnot not work
     public function lead_company()
    {
        // return $this->belongsTo('App\LeadGeneration\LeadCompany');
      // return $this->belongs_to('App\LeadGeneration\LeadCompany', 'lead_company_id'); 
    	 return $this->belongsTo(LeadCompany::class);
    } 
    public function brand_services()
    {
         return $this->hasMany(LeadBrandService::class);
    }

}
