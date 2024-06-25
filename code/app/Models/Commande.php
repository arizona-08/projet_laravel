<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commande';
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

    public function vehicule() {
        return $this->hasOne(Vehicule::class, 'id', 'vehicule_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}