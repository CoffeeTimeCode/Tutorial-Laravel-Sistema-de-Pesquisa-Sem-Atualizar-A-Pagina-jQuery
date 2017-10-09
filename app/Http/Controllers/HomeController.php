<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Categorias;
use App\Posts;
use App\RelacaoPostCategoria;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Posts::where('ativo','=',true)->orderBy('created_at','desc')->paginate(4);
      foreach ($posts as $key => $value) {
        $posts[$key]->categoria = RelacaoPostCategoria::
                                  join('categorias','relacao_post_categoria.categoria_id','=','categorias.id')
                                  ->where('relacao_post_categoria.post_id','=',$posts[$key]->id)
                                  ->first()->categoria;
      }
      return view('home')->with('posts', $posts)->with('categorias', Categorias::get());
    }
}
