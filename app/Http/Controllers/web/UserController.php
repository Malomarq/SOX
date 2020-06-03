<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Redirects to main site
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        //var_dump(Auth::user());
        //$user = User::find(Auth::user()->idUser);
        //return view('user.index', ['user'=>$user]);
        return view('user.index');
    }
}
