<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function listOrders()
    {
        $orders = [];
        $list = Order::all();
        foreach ($list as $item) {
            array_push($orders, $item->getSets());
        }

        return response()->json($orders, 200);
    }

    public function findOrders(Request $req){

        if(!Order::where('idUser', $req->idUser)->exists()){
            return response()->json('empty', 200);
        }

        $orders = Order::where('idUser', $req->idUser)->orderBy('pay')->get();
        return response()->json($orders, 200);
    }

    public function orderPrice(Request $req){

        $price = DB::table('set')
                ->where('idOrder', $req->idOrder)
                ->sum('setPrice');

        return response()->json($price, 200);
    }
}
