<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BContent extends Model
{
    //
    protected $table = 'b_content';

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
        return $this->hasOne('App\B');
    }
}
