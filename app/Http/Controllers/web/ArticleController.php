<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    /**
     * Renders index view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        return view('index');
    }

    /**
     * Renders designer view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function design() {

        return view('design');
    }

    /**
     * Renders product view with a particular article data by its id
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function find(Request $req){

        if($req->has('prod')){
            $id = DB::table('article')->where('name', 'like', $req->prod)->value('idArt');
            if($id != null){
                return view('product', ['art' => $id]);
            } else {
                return redirect()->route('index');
            }
        }

        return view('product', ['art' => $req->id]);

    }
}
