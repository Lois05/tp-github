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
        'image',
        'statut',
        'bien_id',
        'user_id',
];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'bien_id');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }


    public function signalements()
    {
        return $this->hasMany(Signalement::class);
    }

}
