<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Gets info about all admins
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAdmins(){

        return response()->json(User::select('name', 'lastname', 'email')->where('role', 'like', 1)->get());
    }

    /**
     * Deletes an admin by id
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAdmin(Request $req){

        $user = User::where('idUser', 'like', $req->idad);

        $user->delete();

        return response()->json('Ok', 200);
    }

    /**
     * Gets an admin by id
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function findAdmin(Request $req){

        return response()->json(User::where('idUser', 'like', $req->idad)->get());
    }

    /**
     * Updates name, lastname or password of an admin
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Checks if a email exists
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkEmail(Request $req){

        $val = $req->input('check');

        return response()->json(User::where('email', 'like', '%' . $val . '%')->exists());

    }

    /**
     * Creates an admin account
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Finds users by id, name, lastname or email
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchUser(Request $req){

        $val = $req->search;

        $user = User::where('idUser', 'like', '%' . $val . '%')->orWhere('name', 'like', '%' . $val . '%')
                ->orWhere('lastname', 'like', '%' . $val . '%')->orWhere('email', 'like', '%' . $val . '%')
                ->get();
        return response()->json(['search' => $user],200);
    }

    /**
     * Finds orders and their info by id, user id, address, or date
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchOrder(Request $req){

        $val = $req->search;

        $order = DB::table('order')
            ->join('set', 'set.idOrder', '=', 'order.idOrder')
            ->select(DB::raw('sum(set.setPrice) as totalPrice'), 'order.pay', 'order.idOrder', 'order.address',
                'order.idUser')
            ->where('open', 0)
            ->where('order.idUser', 'like', '%' . $val . '%')
            ->orWhere('order.idOrder', 'like', '%' . $val . '%')
            ->orWhere('order.address', 'like', '%' . $val . '%')
            ->orWhere('order.pay', 'like', '%' . $val . '%')
            ->groupBy('order.idOrder', 'order.pay', 'order.address', 'order.idUser')
            ->orderBy('order.pay')
            ->get();

        return response()->json(['search' => $order],200);
    }
}
