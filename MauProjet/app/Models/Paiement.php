<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = ['date_paiement', 'montant', 'mode_paiement', 'statut'];

    public function demande()
    {

    }
    //
}
