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
    /**
     * Asociates a set to a determinate order, adding items to the shopping bag
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $req)
    {

        $prod = Article::find($req->idart);
        $user = User::find($req->iduser);

        if (empty($prod) || empty($user)) {
            return response()->json('Product unavailable', 422);
        }

        if (Order::where('idUser', $user->idUser)->where('open', 1)->exists()) {

            // if the user has an opened order -> adds set to the order

            $idOrder = Order::select('idOrder')->where('idUser', $user->idUser)->where('open', 1)->pluck('idOrder');

            Set::create(
                [
                    'idOrder' => $idOrder[0],
                    'idArt' => $prod->idArt,
                    'amount' => 1,
                    'setPrice' => $prod->price,
                ]);

            return response()->json('Product added to bag', 200);

        } else {

            // if the user has not an opened order -> creates an order and adds set to it

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
                    'amount' => 1,
                    'setPrice' => $prod->price,
                ]);

            return response()->json('Product added to bag', 200);
        }
    }

    /**
     * Counts how many items are in the shopping bag
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Gets the content of the shopping bag. If shopping bag is full, it gets its items and the total price.
     * If shopping bag has no items it returns "empty"
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBag(Request $req)
    {

        if (Order::where('idUser', $req->iduser)->where('open', 1)->exists()) {

            $bag = DB::table('set')
                ->join('order', 'set.idOrder', '=', 'order.idOrder')
                ->join('user', 'user.idUser', '=', 'order.idUser')
                ->join('article', 'article.idArt', '=', 'set.idArt')
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

    /**
     * Adds the amounts of items and the price to the set
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */

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

    /**
     * Deletes a set of an opened order
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSet(Request $req){

        $set = Set::find($req->idSet);

        if ($set != null) {

            $query = Set::where('idOrder', $req->idOrder)->get();
            $rows = count($query);

            if($rows > 1){
                // if order has more than 1 set -> deletes the set
                $set->delete();
            } else {
                // if order has only 1 set -> deletes the order
                $set->delete();
                $order = Order::find($req->idOrder);
                $order->delete();
            }

            return response()->json('ok', 200);

        } else {
            return response()->json('error', 200);
        }
    }

    /**
     * Closes an opened order, "buying" the shopping bag and ending the purchase process
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function buybag(Request $req){

        $order = Order::where('idUser', $req->iduser)->where('open', 1)->first();

        $order->address = $req->address;
        $order->pay = date("Y-m-d");
        $order->open = 0;
        $order->save();

        return response()->json('ok', 200);
    }
}
