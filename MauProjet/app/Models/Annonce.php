<?php

namespace App\Models;

use App\Models\Avis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'localisation', 'prix', 'statut', 'bien_id', 'proprietaire_id'];

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'bien_id');
    }

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class, 'proprietaire_id');
    }
    //
    public function avis()
    {
        return $this->hasMany(\App\Models\Avis::class);
    }


}
