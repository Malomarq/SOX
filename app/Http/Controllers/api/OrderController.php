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



        /*$orders = DB::table('order')
            ->join('set', 'set.idOrder', '=', 'order.idOrder')
            ->join('user', 'user.idUser', '=', 'order.idUser')
            ->join('article', 'article.idArt', '=', 'set.idArt')
            ->select('article.image', 'article.name', 'article.price',
                'set.amount', 'set.setPrice', 'order.idOrder', 'order.pay')
            ->where('user.idUser', $req->iduser)
            ->get();*/

        // idOrders de los orders del usuario

        $idOrders = [];
        $sets = [];
        $arts = [];
        $orders = Order::select('idOrder', 'pay')->where('idUser', $req->iduser)->get();

        foreach ($orders as $item){
            array_push($idOrders, $item->idOrder);
        }

        // con cada idOrder, sacar los datos que quiera de cada set

        foreach ($idOrders as $item) {
            array_push($sets, Set::select('amount', 'setPrice', 'idArt')->where('idOrder', $item)->get());
        }

        foreach ($sets as $item) {
            array_push($arts, $item->idArt->getArticles());
        }




        return response()->json(['orders' => $orders, 'idsets' => $idOrders,
            'sets' => $sets, 'arts' => $arts], 200);

        //$totalp = DB::table('set')->where('idOrder', $orders)->sum('setPrice');
    }
}
