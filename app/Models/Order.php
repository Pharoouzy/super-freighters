<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number', 'user_id', 'origin', 'destination', 'sub_total', 'customs_fee', 'item_name', 'mode', 'weight', 'status'
    ];

    protected $casts = [
        'customs_fee' => 'float',
        'sub_total' => 'float',
        'weight' => 'float',
    ];

    public $appends = ['total', 'status_name', 'expected_arrival_date'];

    public function getTotalAttribute(){
        return (float)$this->sub_total + $this->customs_fee;
    }

    public function getStatusNameAttribute(){
        return config('constants.order_statuses')[$this->status];
    }

    public function getExpectedArrivalDateAttribute(){
        $dateOrdered = Carbon::parse($this->created_at);
        $expectedArrivalDate = $dateOrdered->addDays($this->modeOfTransport->expected_arrival_day);
        return $expectedArrivalDate->toFormattedDateString();
    }

    public function getDateOrderedAttribute(){
        $dateOrdered = Carbon::parse($this->created_at)->toFormattedDateString();
        return $dateOrdered;
    }

    public function transaction() {
        return $this->hasOne(Transaction::class);
    }

    public function modeOfTransport() {
        return $this->belongsTo(Mode::class, 'mode');
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
