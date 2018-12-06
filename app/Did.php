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
        'edication_id',
        'femili',
        'description',
        'created_at',
        'updated_at'
    ];

    public function education()
    {
        return $this->belongsToMany(Edication::class);
    }
}
