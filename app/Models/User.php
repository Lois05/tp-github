<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Ajoute ces imports en fonction de la structure de ton projet
use App\Models\Annonce;
use App\Models\DemandeLocation;
use App\Models\Avis;
use App\Models\Proprietaire;
use App\Models\Locataire;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function proprietaire()
    {
        return $this->hasOne(Proprietaire::class);
    }

    public function locataire()
    {
        return $this->hasOne(Locataire::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }

    public function demandes()
    {
        return $this->hasMany(DemandeLocation::class, 'locataire_id');
    }

    public function avisRecus()
    {
        return $this->hasMany(Avis::class, 'user_id'); // adapte la clé étrangère si besoin
    }

    /**
     * Retourne le nom complet de l'utilisateur.
     */
    public function fullname()
    {
        return trim($this->prenom . ' ' . $this->nom);
    }
}
