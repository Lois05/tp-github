<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = ['date_paiement', 'montant', 'mode_paiement', 'type_paiement', 'statut', 'demande_location_id'];

    public function demandeLocation()
    {
        return $this->belongsTo(DemandeLocation::class, 'demande_location_id');
    }
    //
}
