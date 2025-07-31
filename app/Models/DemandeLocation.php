<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandeLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'message',
        'date_debut',
        'date_fin',
        'statut',
        'bien_id',
        'locataire_id',
        'proprietaire_id',
        'annonce_id',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relations
    public function bien()
    {
        return $this->belongsTo(Bien::class, 'bien_id');
    }

    public function locataire()
    {
        return $this->belongsTo(Locataire::class, 'locataire_id');
    }


    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'demande_location_id');
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class, 'proprietaire_id');
    }
}
