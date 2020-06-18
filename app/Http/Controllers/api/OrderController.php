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

        $orders = DB::table('order')
                    ->join('set', 'set.idOrder', '=', 'order.idOrder')
                    ->select(DB::raw('sum(set.setPrice) as totalPrice'), 'order.pay', 'order.idOrder', 'order.address')
                    ->where('order.idUser', $req->idUser)
                    ->groupBy('order.idOrder', 'order.pay', 'order.address')
                    ->orderBy('order.pay')
                    ->get();

        return response()->json($orders, 200);
    }

}
