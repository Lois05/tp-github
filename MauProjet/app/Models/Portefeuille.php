<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portefeuille extends Model
{
    use HasFactory;

    protected $fillable = ['locataire_id', 'proprietaire_id', 'admin_id', 'solde', 'devise'];

    public function locataire()
    {
        return $this->belongsTo(Locataire::class, 'locataire_id');
    }

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class, 'proprietaire_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    //
}
