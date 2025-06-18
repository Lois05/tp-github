<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeLocation extends Model
{
    use HasFactory;

    protected $fillable = ['id_bien', 'id_locataire', 'date_debut', 'date_fin', 'statut'];

    public function bien()
    {

    }
    //
}
