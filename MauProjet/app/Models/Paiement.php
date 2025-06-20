<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = ['datePaiement', 'montant', 'modePaiement', 'statut', 'demandeLocation_id'];

    public function demandeLocation()
    {
        return $this->belongsTo(DemandeLocation::class, 'demandeLocation_id');
    }
    //
}
