<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'user' ;
    protected $primaryKey = 'idUser' ;

    private const ADMIN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // TODO refund

    /**
     * Checks if user has admin role
     * @return bool
     */
    public function adminRole(){
        return $this->role == User::ADMIN;
    }

    /**
     * Checks user's role
     * @param $role
     * @return bool
     */
    public function role($role){
        return $this->role == $role;
    }

    // END

    public function getOrders(){

        return $this->hasMany('App\Models\Order', 'idUser')->get();
    }

}
