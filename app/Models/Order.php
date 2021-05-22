<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number', 'user_id', 'origin', 'destination', 'sub_total', 'custom_fee',
    ];

    public $appends = ['total'];

    public function getTotalAttribute(){
        return $this->sub_total + $this->custom_fee;
    }

    public function transaction() {
        return $this->hasOne(Transaction::class);
    }

    public function countryOfOrigin() {
        return $this->belongsTo(Country::class, 'origin');
    }

    public function countryOfDestination() {
        return $this->belongsTo(Country::class, 'destination');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
