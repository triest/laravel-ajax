<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class A extends Model
{
    //
    protected $table = 'a';

    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function Content()
    {
        return $this->hasMany('App\AContent');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function education()
    {
        return $this->hasOne('App\Education', 'id', 'education_id');
    }


    public function getEducationName()
    {
        $education = $this->education()->first();
        $education = $education->name;
        return $education;
    }


}
