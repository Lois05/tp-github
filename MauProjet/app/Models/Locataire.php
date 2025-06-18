<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'mot_de_passe', 'telephone'];

    public function portefeuille()
    {

    }
    //
}
