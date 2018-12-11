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
        'title',
        'description',
        'created_at',
        'updated_at'
    ];

    public function randContent()
    {
        return $this->hasMany('App\AContent');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
