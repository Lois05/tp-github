<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = ['note', 'date', 'commentaire', 'user_id', 'annonce_id', 'masque'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class, 'annonce_id');
    }
    //
}
