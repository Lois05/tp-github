<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proprietaire extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'mot_de_passe', 'telephone'];

    public function portefeuille()
    {
        return $this->hasOne(Portefeuille::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'id_proprietaire');
    }
    //
}
