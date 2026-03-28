<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousTraitant extends Model
{
    protected $table = 'sous_traitants';

    protected $fillable = [
        'nom',
        'email'
    ];
}
