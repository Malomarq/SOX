<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function listAdmins(){

        return response()->json(User::select('name', 'lastname', 'email')->where('role', 'like', 1)->get());
    }

    public function deleteAdmin(Request $req){

        $user = User::where('idUser', 'like', $req->idad);

        $user->delete();

        return response()->json('Ok', 200);
    }

    public function findAdmin(Request $req){

        return response()->json(User::where('idUser', 'like', $req->idad)->get());
    }

    public function updateAdmin(Request $req){

        $validate = Validator::make($req->all(),
            [
                'name' => "string|max:50|nullable",
                'lastname' => "string|max:50|nullable",
                'pass' => "string|min:8|nullable",
            ]);

        if($validate->fails()){
            return response()->json(['error' => true, 'message' => 'Validation fails'], 422);
        }

        $user = User::find($req->idad);

        $user->name = ($req->name)? $req->name : $user->name;
        $user->lastname = ($req->lastname)? $req->lastname : $user->lastname;

        $user->password = ($req->pass)? Hash::make($req->pass) : $user->password;

        $user->save();

        if($req->pass == null){
            return response()->json(['User updated', 'pass' => null], 200);
        } else {
            return response()->json(['User updated', 'pass' => 'filled'], 200);
        }
    }

    public function checkEmail(Request $req){

        $val = $req->input('check');

        return response()->json(User::where('email', 'like', '%' . $val . '%')->exists());

    }

    public function createAdmin(Request $req){

        $req->validate(['name' => 'string|max:50|filled']);
        $req->validate(['lastname' => 'string|max:50|filled']);
        $req->validate(['email' => 'email|max:50|filled']);
        $req->validate(['pass' => 'string|min:8|filled']);

        if(User::where('email', 'like', $req->email)->exists()){
            return response()->json(['dbemail' => true],
                200);
        }

        User::create(
            [
                'name' => $req->name,
                'lastname' => $req->lastname,
                'email' => $req->email,
                'password' => Hash::make($req->pass),
                'role' => 1
            ]);

        return response()->json('Ok', 200);
    }
}
