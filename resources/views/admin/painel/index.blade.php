@extends('admin.app')

@section('content')
  <div class="alert alert-info">total de Visualizações: {!! $total_visualizacoes !!}</div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Posts mais visualizados:</h3>
    </div>
    <div class="panel-body" style="padding:0px;">
      <table class="table table-striped">
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Data</th>
          <th>Visualizações</th>
        </tr>
          <?php foreach ($posts as $key => $value): ?>
            <tr>
              <td>{!!$value->id!!}</td>
              <td>{!!$value->titulo!!}</td>
              <td>{!!$value->created_at->diffForHumans()!!}</td>
              <td>{!!$value->visualizacao!!}</td>
            </tr>
          <?php endforeach; ?>
      </table>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Comentários Em-Análize:</h3>
    </div>
    <div class="panel-body" style="padding:0px;">
      <table class="table table-striped">
        <tr>
          <th>ID</th>
          <th>Post Id</th>
          <th>Nome</th>
          <th>Conteudo</th>
          <th>Status</th>
          <th>Data</th>
        </tr>
          <?php foreach ($comentarios as $key => $value): ?>
            <tr>
              <td>{!!$value->id!!}</td>
              <td>{!!$value->post_id!!}</td>
              <td>{!!$value->nome!!}</td>
              <td class="text-justify" style="max-width: 350px;">{!!$value->conteudo!!}</td>
              <td><span class="label label-warning">{!!$value->status!!}</span></td>
              <td>{!!$value->created_at->diffForHumans()!!}</td>
            </tr>
          <?php endforeach; ?>
      </table>
    </div>
  </div>
@endsection
