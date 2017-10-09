@extends('admin.app')
@section('content')
<h3>Lista de Posts</h3>
<div class="row">
  <div class="col-md-12">
    <form class="" action="{!!url('pesquisar-post')!!}" method="post">
      {{csrf_field()}}
      <div class="form-group pull-right">
        <label for="">Pesquisar</label>
        <input type="text" name="pesquisar" class="form-control" id="" placeholder="Pesquisar">
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table table-striped">
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Categoria</th>
        <th>Data</th>
        <th>Visualizações</th>
        <th>Ações</th>
      </tr>
        <?php foreach ($posts as $key => $value): ?>
          <tr>
            <td>{!!$value->id!!}</td>
            <td>{!!$value->titulo!!}</td>
            <td>{!!$value->categoria!!}</td>
            <td>{!!$value->created_at->diffForHumans()!!}</td>
            <td>{!!$value->visualizacao!!}</td>
            <td>
              <a href="{!! url('post/'.$value->categoria.'/'.$value->slug) !!}" class="btn btn-default">Visualizar</a>
              <a href="{!!url('/editar-post/'.$value->id)!!}" class="btn btn-info">Editar</a>
              <a href="{!!url('/deletar-post/'.$value->id)!!}" class="btn btn-danger">Deletar</a>
            </td>
          </tr>
        <?php endforeach; ?>
    </table>
  </div>
</div>
@endsection
