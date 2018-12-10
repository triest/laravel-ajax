<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    protected $table = 'educations';

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function did()
    {
        return $this->hasMany('App\B');
    }
}
