<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function listAll(){

        return response()->json(User::select('idUser', 'name', 'lastname', 'email')->get());
    }

    public function findUser(Request $req){

        return response()->json(User::select('name', 'lastname', 'email')
            ->where('idUser', $req->iduser)->get());
    }

    public function updatePass(Request $req){

        //validaciones

        return response()->json([$req->all()]);
    }
}
