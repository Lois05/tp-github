<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proprietaire extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'password', 'telephone'];

    protected $hidden = ['password'];

    public function portefeuille()
    {
        return $this->hasOne(Portefeuille::class, 'proprietaire');
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'id_proprietaire');
    }
    //
}
