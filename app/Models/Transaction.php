<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'reference', 'amount', 'authorization_url', 'access_code',
        'response_code', 'response_description', 'status', 'response_full'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['response_full'];

    public $appends = ['status_name'];

    public function getStatusNameAttribute(){
        return config('constants.payment_statuses')[$this->status];
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
