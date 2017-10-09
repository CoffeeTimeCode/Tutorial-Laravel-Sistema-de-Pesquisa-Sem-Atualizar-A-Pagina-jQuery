<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Posts;
use App\Categorias;
use App\RelacaoPostCategoria;

class PesquisaController extends Controller
{
    public function pesquisar(Request $request)
    {
      $dados = [];
      $dados['url'] = url('/');
      $dados['posts'] = Posts::where('titulo','like','%'.$request->input('pesquisar').'%')->where('ativo','=',true)->get();
      foreach ($dados['posts'] as $key => $value) {
        $dados['posts'][$key]->categoria = RelacaoPostCategoria::
                                  join('categorias','relacao_post_categoria.categoria_id','=','categorias.id')
                                  ->where('relacao_post_categoria.post_id','=',$dados['posts'][$key]->id)
                                  ->first()->categoria;
      }
      return response()->json($dados);
    }
}
