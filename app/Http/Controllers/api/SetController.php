<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetController extends Controller
{

    public function listSets(Request $req){

        $sets = DB::table('set')
            ->join('article', 'article.idArt', '=', 'set.idArt')
            ->select('article.image', 'article.name', 'article.price', 'set.amount', 'set.setPrice')
            ->where('idOrder', $req->idOrder)
            ->get();

        return response()->json($sets, 200);
    }
}
