<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
