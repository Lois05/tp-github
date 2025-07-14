<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandeLocation extends Model
{
    use HasFactory;

    protected $fillable = ['date_debut', 'date_fin', 'statut', 'bien_id', 'locataire_id'];

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'id_bien');
    }

   public function locataire()
{
    return $this->belongsTo(User::class, 'locataire_id');
}


    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'demande_location_id');
    }
    //
}
