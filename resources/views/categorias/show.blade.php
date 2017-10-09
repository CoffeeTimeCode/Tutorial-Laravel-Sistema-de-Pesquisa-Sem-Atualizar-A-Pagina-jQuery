@section('title','Sistema Post 2 - '.$categoria->categoria)
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-offset-1 col-md-8">
      <div class="col-md-12">
        <h1 class="text-center">Categoria: {!! $categoria->categoria !!}</h3>
      </div>

      <div class="col-md-12">
        <?php foreach ($posts as $key => $value): ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">{!! $value->titulo !!}</h3>
            </div>
            <div class="panel-body" style="padding:0px;" align="center">
                <img src="{!! url($value->imagem) !!}" class="img-responsive">
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

    </div>
  </div>
</div>
@endsection
