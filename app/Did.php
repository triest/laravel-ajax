<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Did extends Model
{
    //
    protected $table = 'bids';

    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'education_id',
        'femili',
        'description',
        'created_at',
        'updated_at',
        'ip'
    ];

    public function education()
    {
        return $this->hasOne('App\Education', 'id', 'education_id');
    }

    public function getEducationName()
    {
        $education = $this->education()->first()->name;
        return $education;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
