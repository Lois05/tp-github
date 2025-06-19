<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = ['note', 'date', 'locataire_id', 'bien_id'];

    public function locataire()
    {
        return $this->belongsTo(Locataire::class, 'locataire_id');
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'bien_id');
    }
    //
}
