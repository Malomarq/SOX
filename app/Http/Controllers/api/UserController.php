<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Gets info of all users
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAll()
    {

        return response()->json(User::select('idUser', 'name', 'lastname', 'email')->get());
    }

    /**
     * Finds an user by id
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function findUser(Request $req)
    {

        return response()->json(User::select('name', 'lastname', 'email')
            ->where('idUser', $req->iduser)->get());
    }

    /**
     * Updates user's password checking current and confirmation password
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Updates user's name and lastname
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Checks input password and current password (in order to complete other actions)
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkPass(Request $req){

        $validate = Validator::make($req->all(),
            [
                'pass' => 'string|min:8|nullable'
            ]);

        if ($validate->fails()) {
            return response()->json(['message' => 'Validation fails', 'error' => 'validate'], 422);
        }

        $user = User::find($req->idUser);

        if (Hash::check($req->pass, $user->password)) {
            return response()->json('ok', 200);
        } else {
            return response()->json(['message' => 'Not match', 'error' => 'match'], 422);
        }

    }

    /**
     * Deletes an user by id
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser(Request $req){

        $user = User::find($req->idUser);
        $user->delete();

        return response()->json('Ok', 200);

    }

    /**
     * Gets how many accounts per month are active at the app
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(){

        $users = DB::table('user')
            ->select(DB::raw('count(idUser) as "values"'), DB::raw('extract(month from created_at) as "month"'))
            ->groupBy('month')
            ->get();

        return response()->json($users, 200);
    }
}
