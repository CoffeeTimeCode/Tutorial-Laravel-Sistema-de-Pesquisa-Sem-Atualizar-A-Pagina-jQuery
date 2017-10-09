<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Categorias;
use App\RelacaoPostCategoria;
use App\Posts;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slugCategoria)
    {
      $posts = Posts::select('posts.*')
                ->join('relacao_post_categoria','relacao_post_categoria.post_id','=','posts.id')
                ->join('categorias','relacao_post_categoria.categoria_id','=','categorias.id')
                ->where('categorias.slug','=',$slugCategoria)
                ->where('posts.ativo','=',true)
                ->orderBy('posts.created_at','desc')
                ->paginate(4);
      foreach ($posts as $key => $value) {
        $posts[$key]->categoria = RelacaoPostCategoria::
                                  join('categorias','relacao_post_categoria.categoria_id','=','categorias.id')
                                  ->where('relacao_post_categoria.post_id','=',$posts[$key]->id)
                                  ->first()->categoria;
      }

      return view('categorias.show')->with('posts',$posts)->with('categoria',Categorias::where('slug','=',$slugCategoria)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
