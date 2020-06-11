<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Shows user main site
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('user.index');
    }

    /**
     * Shows user shopping bag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function bag() {
        return view('shoppingbag');
    }

    /**
     * Shows buy view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function buy(){
        return view('buy');
    }
}
