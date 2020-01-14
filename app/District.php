<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'id',
        'name',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
