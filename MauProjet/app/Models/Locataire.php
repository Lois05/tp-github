<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locataire extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'mot_de_passe', 'telephone'];

    public function portefeuille()
    {
        return $this->hasOne(Portefeuille::class);
    }

    public function demandes()
    {
        return $this->hasMany(DemandeLocation::class, 'id_locataire');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class, 'id_locataire');
    }
    //
}
