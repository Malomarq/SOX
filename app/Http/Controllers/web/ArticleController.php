<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Render index view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        return view('index');
    }

    /**
     * Render product view with a particular article data by its id
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function find(Request $req){

        if($req->has('prod')){
            $id = DB::table('article')->where('name', 'like', $req->prod)->value('idArt');
            return view('product', ['art' => $id]);
        }

        return view('product', ['art' => $req->id]);

    }
}
