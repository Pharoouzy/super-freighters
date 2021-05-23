<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mode extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'base_fare', 'fare_per_kg', 'expected_arrival_day'];

    protected $casts = [
        'base_fare' => 'float',
        'fare_per_kg' => 'float',
    ];
}
