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
        'superAdmin',
        'aOrganizer',
        'bOrganizer'
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


    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        //  echo $this->superAdmin;
        if ($this->superAdmin == 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        if ($this->admin == 1) {
            return true;
        }
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rand()
    {
        return $this->belongsToMany(A::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dids()
    {
        return $this->belongsToMany(B::class);
    }
}
