<?php

namespace App\Http\Controllers\api;

use App\Models\Article;
use App\Models\User;
use App\Models\Order;
use App\Models\Set;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShoppingBagController extends Controller
{
    public function add(Request $req)
    {

        $prod = Article::find($req->idart);
        $user = User::find($req->iduser);

        //$price = $prod->price * $req->amount;

        //if (empty($prod) || empty($user) || $req->amount < 1 || $req->amount > 5) {
        if (empty($prod) || empty($user)) {
            return response()->json('Product unavailable', 422);
        }

        if (Order::where('idUser', $user->idUser)->where('open', 1)->exists()) {

            // si ese usuario tiene pedido abierto -> sumar lote al pedido

            $idOrder = Order::select('idOrder')->where('idUser', $user->idUser)->where('open', 1)->pluck('idOrder');

            Set::create(
                [
                    'idOrder' => $idOrder[0],
                    'idArt' => $prod->idArt,
                    /*'amount' => $req->amount,
                    'setPrice' => $price,*/
                    'amount' => 1,
                    'setPrice' => $prod->price,
                ]);

            return response()->json('Product added to bag', 200);

        } else {

            // si ese usuario no tiene pedido abierto -> crear pedido

            Order::create(
                [
                    'idUser' => $user->idUser,
                    'date' => date("Y-m-d"),
                    'address',
                    'pay',
                    'open' => 1
                ]);

            $idOrder = Order::select('idOrder')->where('idUser', $user->idUser)->where('open', 1)->pluck('idOrder');

            Set::create(
                [
                    'idOrder' => $idOrder[0],
                    'idArt' => $prod->idArt,
                    /*'amount' => $req->amount,
                    'setPrice' => $price,*/
                    'amount' => 1,
                    'setPrice' => $prod->price,
                ]);

            return response()->json('Product added to bag', 200);
        }
    }

    public function getItems(Request $req)
    {
        $tot = DB::table('set')
            ->join('order', 'set.idOrder', '=', 'order.idOrder')
            ->join('user', 'user.idUser', '=', 'order.idUser')
            ->select('idSet')
            ->where('user.idUser', $req->iduser)
            ->where('order.open', 1)
            ->count();

        return response()->json($tot, 200);
    }

    public function getBag(Request $req)
    {

        if (Order::where('idUser', $req->iduser)->where('open', 1)->exists()) {

            $bag = DB::table('set')
                ->join('order', 'set.idOrder', '=', 'order.idOrder')
                ->join('user', 'user.idUser', '=', 'order.idUser')
                ->join('article', 'article.idArt', '=', 'set.idArt')
                //->select('article.idArt','article.image', 'article.name', 'article.price', 'set.amount')
                ->select('article.idArt', 'article.image', 'article.name', 'article.price', 'set.idSet',
                    'set.amount', 'set.idOrder')
                ->where('user.idUser', $req->iduser)
                ->where('order.open', 1)
                ->get();

            $idOrder = Order::where('idUser', $req->iduser)->where('open', 1)->pluck('idOrder');

            $totalp = DB::table('set')->where('idOrder', $idOrder)->sum('setPrice');

            return response()->json(['bag' => $bag, 'totalp' => round($totalp, 2)], 200);
        } else {
            return response()->json('empty', 200);
        }

    }

    public function amountchange(Request $req)
    {

        $set = Set::find($req->idSet);

        if ($set != null) {

            $idArt = $set->idArt;
            $art = Article::find($idArt);

            $set->amount = $req->amount;
            $set->setPrice = $art->price * $req->amount;

            $set->save();

            return response()->json('ok', 200);

        } else {

            return response()->json('error', 200);
        }

    }

    public function deleteSet(Request $req){

        $set = Set::find($req->idSet);

        if ($set != null) {

            $query = Set::where('idOrder', $req->idOrder)->get();
            $rows = count($query);

            if($rows > 1){
                // el order tiene más de 1 set -> se elimina ese set
                $set->delete();
            } else {
                // el order sólo tiene 1 set -> se elimina el order
                $set->delete();
                $order = Order::find($req->idOrder);
                $order->delete();
            }

            return response()->json('ok', 200);

        } else {
            return response()->json('error', 200);
        }
    }

    public function buybag(Request $req){

        $order = Order::where('idUser', $req->iduser)->where('open', 1)->first();

        $order->address = $req->address;
        $order->pay = date("Y-m-d");
        $order->open = 0;
        $order->save();

        return response()->json('ok', 200);
    }
}
