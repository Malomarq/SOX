<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function listAll()
    {

        return response()->json(User::select('idUser', 'name', 'lastname', 'email')->get());
    }

    public function findUser(Request $req)
    {

        return response()->json(User::select('name', 'lastname', 'email')
            ->where('idUser', $req->iduser)->get());
    }

    public function updatePass(Request $req)
    {

        $validate = Validator::make($req->all(),
            [
                'curpass' => "string|min:8|nullable",
                'newpass' => "string|min:8|nullable",
                'confpass' => "string|min:8|nullable",
            ]);

        if ($validate->fails()) {
            return response()->json(['message' => 'Validation fails', 'error' => 'validate'], 422);
        }

        if ($req->confpass != $req->newpass) {
            return response()->json(['message' => 'Not match', 'error' => 'new-conf'], 422);
        }

        $user = User::find($req->idUser);

        if (Hash::check($req->curpass, $user->password)) {
            $user->password = Hash::make($req->newpass);
            $user->save();
            return response()->json('ok', 200);
        } else {
            return response()->json(['message' => 'Not match', 'error' => 'curr'], 422);
        }
    }

    public function updateInfo(Request $req)
    {

        $validate = Validator::make($req->all(),
            [
                'name' => "string|max:50|nullable",
                'lastname' => "string|max:50|nullable",
            ]);

        if ($validate->fails()) {
            return response()->json(['error' => true, 'message' => 'Validation fails'], 422);
        }

        $user = User::find($req->idUser);

        $user->name = ($req->name) ? $req->name : $user->name;
        $user->lastname = ($req->lastname) ? $req->lastname : $user->lastname;

        $user->save();

        return response()->json('User updated', 200);
    }
}
