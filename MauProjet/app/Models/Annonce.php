<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = ['id_bien', 'id_proprietaire'];

    public function bien()
    {

    }
    //
}
