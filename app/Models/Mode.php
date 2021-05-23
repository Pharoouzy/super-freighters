<?php

namespace App\Models;

use Carbon\Carbon;
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

    public $appends = ['expected_arrival_date'];

    public function getExpectedArrivalDateAttribute(){
        $expectedArrivalDate = Carbon::today()->addDays($this->expected_arrival_day);
        return $expectedArrivalDate->toFormattedDateString();
    }
}
