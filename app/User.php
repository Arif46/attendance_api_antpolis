<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'first_name','last_name','email', 'password','financial_statements',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 
         'financial_statements' => 'json',
         'work_experience' => 'json'
    ];
    // public function getFullNameAttribute()
    // {
    //     return $this->first_name . ' '.$this->middle_name.' '. $this->last_name;
    // }
    public function user_information(){
        return $this->hasOne(UserInformation::class);
    } 
    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
    public function getFullNameAttribute()
        {
           return $this->first_name . ' ' . $this->middle_name.' '. $this->last_name;
        }
    // for api
          public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
