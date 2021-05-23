<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 */
class Order extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number', 'user_id', 'origin', 'destination', 'sub_total', 'customs_fee', 'item_name', 'mode', 'weight', 'status'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'customs_fee' => 'float',
        'sub_total' => 'float',
        'weight' => 'float',
    ];

    /**
     * @var string[]
     */
    public $appends = ['total', 'status_name', 'expected_arrival_date'];

    /**
     * @return float|mixed
     */
    public function getTotalAttribute(){
        return (float)$this->sub_total + $this->customs_fee;
    }

    /**
     * @return mixed
     */
    public function getStatusNameAttribute(){
        return config('constants.order_statuses')[$this->status];
    }

    /**
     * @return string
     */
    public function getExpectedArrivalDateAttribute(){
        $dateOrdered = Carbon::parse($this->created_at);
        $expectedArrivalDate = $dateOrdered->addDays($this->modeOfTransport->expected_arrival_day);
        return $expectedArrivalDate->toFormattedDateString();
    }

    /**
     * @return string
     */
    public function getDateOrderedAttribute(){
        $dateOrdered = Carbon::parse($this->created_at)->toFormattedDateString();
        return $dateOrdered;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction() {
        return $this->hasOne(Transaction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modeOfTransport() {
        return $this->belongsTo(Mode::class, 'mode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function countryOfOrigin() {
        return $this->belongsTo(Country::class, 'origin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function countryOfDestination() {
        return $this->belongsTo(Country::class, 'destination');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
