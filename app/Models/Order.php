<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'idOrder';

    protected $fillable = [
        'idUser', 'date', 'address', 'pay', 'open'
    ];

    public function getSets()
    {

        return $this->hasMany('App\Models\Set', 'idOrder')->get();
    }

    public function getUser()
    {

        return $this->belongsTo('App\Models\User', 'idUser');
    }
}
