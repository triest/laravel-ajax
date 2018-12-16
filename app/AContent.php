<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AContent extends Model
{
    //
    protected $table = 'a_content';

    protected $fillable = [
        'id',
        'file_name',
        'content_type',
        'created_at',
        'updated_at',
        'rand_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function main()
    {
        return $this->hasOne('App\A');
    }

}
