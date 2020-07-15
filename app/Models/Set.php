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

    /**
     * Gets the order which belongs the set to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getOrder(){

        return $this->belongsTo('App\Models\Order', 'idOrder');
    }

    /**
     * Gets products of a set
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getArticles(){
        return $this->hasMany('App\Models\Article', 'idArt');
    }
}
