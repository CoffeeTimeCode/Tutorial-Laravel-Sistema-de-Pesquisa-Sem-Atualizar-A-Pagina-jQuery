<?php

use App\Posts;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/register',function(){
  return redirect('/');
});

Route::get('/', 'HomeController@index');

Route::post('/post/enviar-comentario','ComentariosController@store');

Route::get('/pesquisar','PesquisaController@pesquisar');

Route::get('/textos',function(){
  return view('pesquisa');
});

Route::get('/categoria/{slugCategoria}','CategoriasController@show');

Route::get('/post/{categoria}/{slugPost}','PostsController@show');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/painel','Admin\PainelController@index');
    Route::get('/categorias','Admin\CategoriasController@index');
    Route::post('/categorias','Admin\CategoriasController@store');

    Route::get('/categorias/editar/{id}','admin\CategoriasController@edit');
    Route::post('/categorias/salvar-alteracao/{id}','Admin\CategoriasController@update');

    Route::get('/categorias/deletar/{id}','Admin\CategoriasController@destroy');

    Route::get('/criar-post','Admin\PostsController@create');
    Route::post('/criar-post','Admin\PostsController@store');

    Route::get('/lista-de-posts','Admin\PostsController@index');

    Route::get('/deletar-post/{id}','Admin\PostsController@destroy');

    Route::post('/pesquisar-post','Admin\PostsController@pesquisar');

    Route::get('/editar-post/{id}','Admin\PostsController@edit');
    Route::post('/editar-post/{id}','Admin\PostsController@update');

    Route::get('/lista-de-comentarios','Admin\ComentariosController@index');
    Route::get('/alterar-status-comentario/{id}/{status}','Admin\ComentariosController@alterarStatus');
 });
