@section('title',$post->titulo)
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <img src="{!! url($post->imagem) !!}" class="img-responsive">
        </div>

        <div class="col-md-12">
          <h1 class="text-center">{!! $post->titulo !!}</h1>
        </div>

        <div class="col-md-12">
          <article class="text-justify">
            {!! $post->conteudo !!}
          </article>
        </div>

        <div class="col-md-6 col-lg-offset-3">
          <h3 class="text-center">Comentários({!! count($comentarios) !!})</h3>
          <div class="row">
            <?php foreach ($comentarios as $key => $value): ?>
              <div class="col-md-12">
                <div class="media alert">
                  <div class="media-body">
                    <h4 class="media-heading">{!! $value->nome !!}<span class="pull-right">{!! $value->created_at->diffForHumans() !!}</span></h4>
                    {!! $value->conteudo !!}
                  </div>
                </div>
              </div>
            <?php endforeach; ?>

          </div>

            <form class="" action="{!! url('post/enviar-comentario') !!}" method="post">
              {!! csrf_field() !!}

              <input type="hidden" name="post_id" value="{{ $post->id }}">

              <div class="form-group">
                <label>Nome:</label>
                <input type="text" class="form-control" name="nome" id="" placeholder="">
              </div>

              <div class="form-group">
                <label>Comentário:</label>
                <textarea type="text" class="form-control" name="conteudo" id=""></textarea>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-success" name="button">Enviar Comentário</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
