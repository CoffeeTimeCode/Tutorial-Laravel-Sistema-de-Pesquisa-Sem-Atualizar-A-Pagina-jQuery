@extends('admin.app')
@section('content')
<form name="frmPost" ng-app="" class="" action="{!! url('criar-post') !!}" method="post" enctype="multipart/form-data">
  {!! csrf_field() !!}
  <div ng-if="frmPost.titulo.$error.required && frmPost.titulo.$dirty" class="alert alert-danger">Título do post em Branco.</div>
  <div ng-if="frmPost.categoria.$error.required && frmPost.categoria.$dirty" class="alert alert-danger">Selecione uma categoria.</div>
  <div ng-if="frmPost.conteudo.$error.required && frmPost.conteudo.$dirty" class="alert alert-danger">Conteúdo do post em Branco.</div>
  <div class="row">
    <h3>Adicionar Post</h3>
    @if (count($errors) != 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-md-12">
        <div class="form-group">
          <label for="">Título:</label>
          <input type="text" ng-model="titulo" class="form-control" name="titulo" placeholder="" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
          <label for="">Selecione uma categoria:</label>
          <select class="form-control" name="categoria" ng-model="categoria" required>
            <option value=""></option>
            @foreach($categorias as $categoria)
            <option value="{!! $categoria->id !!}">{!! $categoria->categoria !!}</option>
            @endforeach
          </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
          <label for="">Selecione uma imagem:</label>
          <input type="file" class="form-control" name="imagem" placeholder="">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
          <label for="">Conteúdo:</label>
          <textarea name="conteudo" class="form-control" rows="4" ng-model="conteudo" required></textarea>
        </div>
    </div>

    <div ng-if="frmPost.$valid" class="col-md-12">
      <button type="submit" class="btn btn-success" name="button">Salvar</button>
    </div>

  </div>
</form>
@endsection
