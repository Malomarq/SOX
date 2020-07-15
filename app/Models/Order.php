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

    /**
     * Gets sets of an order
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSets()
    {

        return $this->hasMany('App\Models\Set', 'idOrder')->get();
    }

    /**
     * Gets the user who belongs the order to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser()
    {

        return $this->belongsTo('App\Models\User', 'idUser');
    }
}
