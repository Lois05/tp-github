<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'localisation', 'prix', 'statut'];

    public function annonce()
    {

    }
    //
}
