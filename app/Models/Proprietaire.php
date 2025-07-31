<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proprietaire extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date_naissance', 'npi', 'raison_sociale', 'registre_commerce', 'representant_legal'];

    protected $hidden = ['password'];

    public function portefeuille()
    {
        return $this->hasOne(Portefeuille::class, 'proprietaire_id');
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'proprietaire_id');
    }
    //
    /**
     * Relation avec l'utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function biens()
    {
        return $this->hasMany(Bien::class, 'proprietaire_id');
    }

    /**
     * Vérifie si le propriétaire est une personne physique.
     */
    public function estPhysique()
    {
        return $this->type === 'physique';
    }

    /**
     * Vérifie si le propriétaire est une personne morale.
     */
    public function estMoral()
    {
        return $this->type === 'moral';
    }

    public function demandesRecues()
    {
        // récupère toutes les demandes sur ses biens
        return $this->hasManyThrough(
            DemandeLocation::class,
            Bien::class,
            'proprietaire_id', // clé étrangère sur biens pointant sur proprietaire
            'bien_id',
            'locataire_id',
                    // clé étrangère sur demande_locations pointant sur bien
            'id',              // clé locale proprietaire
            'id'
                          // clé locale bien
        );
    }
}
