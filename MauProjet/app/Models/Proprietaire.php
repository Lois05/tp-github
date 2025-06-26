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
        return $this->belongsTo(User::class);
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
}
