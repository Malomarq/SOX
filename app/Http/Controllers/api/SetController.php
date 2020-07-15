<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetController extends Controller
{

    /**
     * Gets sets of an order
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function listSets(Request $req){

        $sets = DB::table('set')
            ->join('article', 'article.idArt', '=', 'set.idArt')
            ->join('order', 'order.idOrder', '=', 'set.idOrder')
            ->select('article.image', 'article.name', 'article.idArt', 'article.price',
                    'set.idSet', 'set.amount', 'set.setPrice', 'order.address')
            ->where('set.idOrder', $req->idOrder)
            ->get();

        return response()->json($sets, 200);
    }
}
