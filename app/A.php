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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Content()
    {
        return $this->hasMany('App\AContent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function education()
    {
        return $this->hasOne('App\Education', 'id', 'education_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasOne|mixed|null|object
     */
    public function getEducationName()
    {
        $education = $this->education()->first();
        $education = $education->name;
        return $education;
    }


}
