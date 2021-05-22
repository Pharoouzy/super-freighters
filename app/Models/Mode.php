<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'base_fare', 'fare_per_kg'];
}
