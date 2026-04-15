<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model {
    protected $fillable = ['reservation_id', 'montant', 'methode', 'statut', 'date_paiement'];

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }
}