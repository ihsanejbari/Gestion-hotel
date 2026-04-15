<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chambre extends Model {
    protected $fillable = ['numero', 'type', 'prix', 'capacite', 'description', 'image', 'statut'];

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}