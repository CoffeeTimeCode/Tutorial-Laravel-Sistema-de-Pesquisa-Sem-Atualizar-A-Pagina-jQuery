@section('title','Sistema Post 2')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
          <?php foreach ($posts as $key => $value): ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{!! $value->titulo !!}</h3>
              </div>
              <div class="panel-body" style="padding:0px;" align="center">
                  <img src="{!! $value->imagem !!}" class="img-responsive">
              </div>
              <div class="panel-footer">
                <a href="{!! url('post/'.$value->categoria.'/'.$value->slug) !!}" class="btn btn-success" role="button">Visualizar</a>
              </div>
            </div>
          <?php endforeach; ?>

          <div class="text-center">
            {!! $posts->links() !!}
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Pesquisar</h3>
            </div>
            <div class="panel-body">
              <a href="{!! url('textos') !!}" class="btn btn-success">Ir para a página de pesquisa.</a>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Categorias</h3>
            </div>
            <div class="panel-body">
              <?php foreach ($categorias as $key => $value): ?>
                  <a href="{!! url('categoria/'.$value->slug) !!}" class="btn btn-info">{!! $value->categoria !!}</a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
