<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Gets products ordered by name, price or id
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAll(Request $req)
    {

        if ($req->order == 'name') {
            return response()->json(Article::orderBy('name', 'asc')->paginate(15));
        }

        if ($req->order == 'price') {
            return response()->json(Article::orderBy('price', 'asc')->paginate(15));
        }

        if ($req->order == 'default'){
            return response()->json(Article::where('image', 'like', '%'.$req->colorfilter.'%')->paginate(15));
        }

    }

    /**
     * Gets a product by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function list($id)
    {
        return response()->json(Article::find($id));
    }

    /**
     * Searches products by name
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $req)
    {

        $val = $req->input('search');
        
        return response()->json(Article::where('name', 'like', '%' . $val . '%')->get());

    }

    /**
     * Creates a new product
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $req)
    {

        $req->validate(
            [
                'newimage' => 'image|filled',
                'newname' => 'string|max:100|filled',
                'newprice' => ['filled', 'regex:/^(5|7|10).95$/']
            ]);

        $req->newimage->storeAs('public/articles', $req->newimage->getClientOriginalName());

        Article::create(
            [
                'name' => $req->newname,
                'image' => $req->newimage->getClientOriginalName(),
                'price' => $req->newprice
            ]);

        return response()->json('Ok', 200);

    }

    /**
     * Deletes a product
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $req)
    {

        $prod = Article::find($req->idprod);

        $prod->delete();

        return response()->json('Ok', 200);
    }

    /**
     * Updates name, image or price of a product
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $req)
    {
        $req->validate(
            [
                'upimage' => 'image|nullable',
                'upname' => 'string|max:100|nullable',
                'upprice' => ['regex:/^(5|7|10).95$/', 'nullable']
            ]);

        if ($req->upimage != null) {
            $req->upimage->storeAs('public/articles', $req->upimage->getClientOriginalName());
        }

        $prod = Article::find($req->idArt);

        $prod->name = ($req->upname) ? $req->upname : $prod->name;
        $prod->image = ($req->upimage) ? $req->upimage->getClientOriginalName() : $prod->image;
        $prod->price = ($req->upprice) ? $req->upprice : $prod->price;

        $prod->save();

        return response()->json('Ok', 200);
    }
}
