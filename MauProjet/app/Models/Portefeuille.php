<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portefeuille extends Model
{
    use HasFactory;

    protected $fillable = ['utilisateur_id', 'solde', 'devise'];

    public function utilisateur()
    {

    }
    //
}
