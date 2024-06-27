<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
    ];
    public $timestamps = false;

    public function vehicle()
    {
        return $this->hasMany(Vehicle::class);
    }
}