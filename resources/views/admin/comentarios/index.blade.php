@extends('admin.app')
@section('content')
<h3>Lista de Comentarios</h3>
<div class="row">
  <div class="col-md-12">
    <table class="table table-striped">
      <tr>
        <th>ID</th>
        <th>Post Id</th>
        <th>Nome</th>
        <th>Conteudo</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ações</th>
      </tr>
        <?php foreach ($comentarios as $key => $value): ?>
          <tr>
            <td>{!!$value->id!!}</td>
            <td>{!!$value->post_id!!}</td>
            <td>{!!$value->nome!!}</td>
            <td class="text-justify" style="max-width: 350px;">{!!$value->conteudo!!}</td>
            <?php if ($value->status=="em-análise"): ?>
              <td><span class="label label-warning">{!!$value->status!!}</span></td>
            <?php endif; ?>
            <?php if ($value->status=="ativo"): ?>
              <td><span class="label label-success">{!!$value->status!!}</span></td>
            <?php endif; ?>
            <?php if ($value->status=="desativado"): ?>
              <td><span class="label label-danger">{!!$value->status!!}</span></td>
            <?php endif; ?>
            <td>{!!$value->created_at->diffForHumans()!!}</td>
            <td>
              <a href="{!! url('alterar-status-comentario/'.$value->id.'/ativo') !!}" class="btn btn-info">Ativar</a>
              <a href="{!! url('alterar-status-comentario/'.$value->id.'/desativado') !!}" class="btn btn-danger">Deletar</a>
            </td>
          </tr>
        <?php endforeach; ?>
    </table>
  </div>
</div>
@endsection
