<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'matricule'];

    protected $hidden = ['password'];

    public function portefeuille()
    {
        return $this->hasOne(Portefeuille::class, 'admin_id');
    }
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //
}
