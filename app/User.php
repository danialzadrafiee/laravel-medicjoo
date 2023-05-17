<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'password', 'phone', 'meli_code', 'sheba_code', 'imed_code', 'contract_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];




    public function UserAttr()
    {
        return $this->hasOne(UserAttr::class);
    }

    public function UserAddresses()
    {
        return $this->hasMany(UserAddresses::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function credit()
    {
        return $this->hasOne(Credit::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function BeVendor()
    {
        return $this->hasOne(BeVendor::class);
    }
    public function BadAuth()
    {
        return $this->hasOne(BadAuth::class);
    }
    public function withdraw()
    {
        return $this->hasMany(Withdraw::class);
    }
    public function ForgetCode()
    {
        return $this->hasMany(ForgetCode::class);
    }
}
