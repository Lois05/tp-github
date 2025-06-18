<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = ['note', 'date', 'id_locataire', 'id_bien'];

    public function locataire()
    {

    }
    //
}
