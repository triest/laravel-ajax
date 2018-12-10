<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email',
        'email_verified_at',
        'admin',
        'superAdmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function isSuperAdmin()
    {
        if ($this->superAdmin == 1) {
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        if ($this->admin == 1) {
            return true;
        }
        return false;
    }

    public function rand()
    {
        return $this->belongsToMany(A::class);
    }

    public function dids()
    {
        return $this->belongsToMany(B::class);
    }
}
