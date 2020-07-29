<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldAttendance extends Model
{
    //
    public $timestamps = false;
    // public $attendance_date = false;
     protected $fillable = [
        'user_id','attendance_date','check_in', 'check_out','status',
    ];
    public function user()
	{
	     return $this->belongsTo(User::class);
	 }
}
