<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'model',
        'marque',
        'last_maintenance',
        'nb_kilometrage',
        'nb_serie',
        'status_id',
        'agency_id',
        'supplier_id',
    ];

    public function agency() {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

}
