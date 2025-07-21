<?php
// app/Models/Annonce.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'localisation',
        'description',
        'prix',
        'statut',
        'image',
        'user_id',
        'bien_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'bien_id');
    }

    public function demandes()
    {
        return $this->hasMany(DemandeLocation::class);
    }

    public function categorie()
    {
        return $this->bien ? $this->bien->categorie() : null;
    }
    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'user_id'); // ou Proprietaire si tu as une table Proprietaires
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
}
