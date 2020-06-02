<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $table = 'set';
    protected $primaryKey = 'idSet';

    protected $fillable = [
        'idOrder', 'idArt', 'amount', 'setPrice',
    ];
}
