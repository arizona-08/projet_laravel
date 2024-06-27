<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'dateDebut',
        'dateFin',
        'users_id',
        'vehicule_id'
    ];

    public function vehicle() {
        return $this->hasOne(Vehicle::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}