<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bien extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'categorie_id', 'proprietaire_id'];

    public function annonce()
    {
        return $this->hasOne(Annonce::class, 'bien_id');
    }

    public function demandeLocations()
    {
        return $this->hasMany(DemandeLocation::class, 'bien_id');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class, 'bien_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
     public function proprietaire()
    {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }
}
