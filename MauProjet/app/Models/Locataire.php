<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locataire extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',  'date_naissance', 'npi', 'raison_sociale', 'registre_commerce', 'representant_legal'];

    protected $hidden = ['password'];

    public function portefeuille()
    {
        return $this->hasOne(Portefeuille::class, 'locataire_id');
    }

    public function demandeLocations()
    {
        return $this->hasMany(DemandeLocation::class, 'locataire_id');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class, 'locataire_id');
    }
    //
    /**
     * Relation avec l'utilisateur.
     * Un locataire est lié à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Vérifie si le locataire est une personne physique.
     */
    public function estPhysique()
    {
        return $this->type === 'physique';
    }

    /**
     * Vérifie si le locataire est une personne morale.
     */
    public function estMoral()
    {
        return $this->type === 'moral';
    }

}
