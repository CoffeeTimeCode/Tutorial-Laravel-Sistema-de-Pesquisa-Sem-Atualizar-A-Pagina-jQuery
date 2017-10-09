<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Categorias;
use App\Posts;
use App\RelacaoPostCategoria;

use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Posts::where('ativo','=',true)->orderBy('titulo','asc')->get();
      for ($i=0; $i < count($posts); $i++) {
        $posts[$i]->categoria = RelacaoPostCategoria::
                                join('categorias','relacao_post_categoria.categoria_id','=','categorias.id')
                                ->where('relacao_post_categoria.post_id','=',$posts[$i]->id)
                                ->first()->categoria;
      }
      return view('admin.posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create')->with('categorias',Categorias::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $mensagens = [
        'imagem.required' => 'Você não colocou a imagem no texto.',
        'imagem.mimes' => 'Somente imagem no formato de jpeg e png.',
      ];

      $this->validate($request,[
        'imagem' => 'required|mimes:jpeg,png',
      ],$mensagens);

      $post = new Posts;
      $post->user_id = Auth::user()->id;
      $post->titulo = $request->input('titulo');
      $post->conteudo = $request->input('conteudo');
      $post->slug = $this->criar_slug($request->input('titulo'));
      $post->save();

      $request->file('imagem')->move('imagens-post/',$post->id.'.'.$request->file('imagem')->getClientOriginalExtension());
      $post->imagem = 'imagens-post/'.$post->id.'.'.$request->file('imagem')->getClientOriginalExtension();
      $post->save();

      $relacaoPostCategoria = new RelacaoPostCategoria;
      $relacaoPostCategoria->post_id = $post->id;
      $relacaoPostCategoria->categoria_id = $request->input('categoria');
      $relacaoPostCategoria->save();

      return redirect('painel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::find($id);
        $post->categoria = RelacaoPostCategoria::
                                join('categorias','relacao_post_categoria.categoria_id','=','categorias.id')
                                ->where('relacao_post_categoria.post_id','=',$post->id)
                                ->first()->id;
        return view('admin.posts.edit')->with('post',$post)->with('categorias',Categorias::all());
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
        $post = Posts::find($id);
        $post->titulo = $request->input('titulo');
        $post->conteudo = $request->input('conteudo');
        if(!is_null($request->file('imagem'))){
          $request->file('imagem')->move('imagens-post/',$post->id.'.'.$request->file('imagem')->getClientOriginalExtension());
          $post->imagem = 'imagens-post/'.$post->id.'.'.$request->file('imagem')->getClientOriginalExtension();
        }
        $post->save();

        $categoria = RelacaoPostCategoria::where('post_id','=',$post->id)->first();
        if($categoria->categoria_id!=$request->input('categoria')){
          $categoria->categoria_id = $request->input('categoria');
          $categoria->save();
        }
        return redirect('painel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::find($id);
        $post->ativo = false;
        $post->save();

        return redirect()->back();
    }

    public function pesquisar(Request $request){
      $posts = Posts::where('titulo', 'like', '%'.$request->input('pesquisar').'%')->where('ativo','=',true)->orderBy('titulo','asc')->get();
      for ($i=0; $i < count($posts); $i++) {
        $posts[$i]->categoria = RelacaoPostCategoria::
                                join('categorias','relacao_post_categoria.categoria_id','=','categorias.id')
                                ->where('relacao_post_categoria.post_id','=',$posts[$i]->id)
                                ->first()->categoria;
      }
      return view('admin.posts.index')->with('posts',$posts);
    }

    function criar_slug($titulo){
      $procurar =   ['ã','â','ê','é','í','õ','ô','ú',' '];
      $substituir = ['a','a','e','e','i','o','o','u','-'];
      return str_replace($procurar,$substituir,mb_strtolower($titulo));
    }
}
