<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'start_date',
        'end_date',
        'user_id',
        'vehicle_id',
        'orderstatus_id',
    ];

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderstatus(){
        return $this->belongsTo(OrderStatus::class);
    }
}