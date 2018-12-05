<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'images';

    protected $fillable = [
        'id',
       'image_name',
        'main_id',
        'description',
        'created_at',
        'updated_at'
    ];
}
