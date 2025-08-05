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
        'categorie_id',  // Assure-toi que c'est 'categorie_id' ici et non 'categorie'
        'prix',
        'image',
        'statut',
        'bien_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function signalements()
    {
        return $this->hasMany(Signalement::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function proprietaire()
{
    return $this->belongsTo(User::class, 'proprietaire_id');
}

public function images()
{
    return $this->hasMany(Image::class, 'annonce_id');
}

}
