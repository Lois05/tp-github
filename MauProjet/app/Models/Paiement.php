<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = ['date_paiement', 'montant', 'mode_paiement', 'statut', 'demandeLocation_id'];

    public function demandelocation()
    {
        return $this->belongsTo(DemandeLocation::class, 'demande_location_id');
    }
    //
}
