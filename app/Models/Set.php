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

    public function getOrder(){

        return $this->belongsTo('App\Models\Order', 'idOrder');
    }
}
