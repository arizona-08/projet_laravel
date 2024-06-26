<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $table = 'agence';
    protected $fillable = [
        'label',
        'users_id'
    ];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicule::class);
    }


}