<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RandContent extends Model
{
    //
    protected $table = 'rand_content';

    protected $fillable = [
        'id',
        'file_name',
        'content_type',
        'created_at',
        'updated_at',
        'rand_id'
    ];

    public function main()
    {
        return $this->hasOne('App\Rand');
    }

}
