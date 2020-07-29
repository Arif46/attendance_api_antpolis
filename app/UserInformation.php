<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    //
	 protected $fillable = [
        'user_id','financial_information','work_experience','educational_qualification','skill',
    ];
    protected $casts = [
    'financial_information' => 'json',
    'work_experience' => 'json',
    'educational_qualification' => 'json',
    'skill' => 'json',
	];
	public function user()
	{
	     return $this->belongsTo(User::class);
	 }

}
