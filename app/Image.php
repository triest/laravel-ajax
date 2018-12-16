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
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function main()
    {
        return $this->hasOne('App\Main');
    }
}
