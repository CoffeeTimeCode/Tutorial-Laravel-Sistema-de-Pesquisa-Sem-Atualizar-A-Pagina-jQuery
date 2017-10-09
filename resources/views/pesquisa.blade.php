@section('title','Sistema Post 2 - Página de Pesquisa')
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-offset-1 col-md-8">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Pesquisar</h3>
          </div>
          <div class="panel-body">
            <input type="text" class="form-control" id="pesquisar" name="pesquisar">
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <h4 id="qtde" ></h4>
      </div>

      <div id="textos" class="col-md-12">

      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  $('#pesquisar').keyup(function(){

    if($('#pesquisar').val().length >= 3){
      $('#qtde').html("Pesquisando...");

      $.get("{!! url('pesquisar') !!}", {pesquisar:$('#pesquisar').val()},function(data){
        $('#qtde').html(data.posts.length.toString()+" Resultados");

        var html = "";
        for (var i = 0; i < data.posts.length; i++) {
          html += "<div class='panel panel-default'>";
          html += "<div class='panel-heading'>";
          html += "<h3 class='panel-title'> "+data.posts[i].titulo+" </h3>";
          html += "</div>";
          html += "<div class='panel-body' style='padding:0px;' align='center'>";
          html += "<img src=' "+data.posts[i].imagem+" ' class='img-responsive'>";
          html += "</div>";
          html += "<div class='panel-footer'>";
          html += "<a href=' "+data.url+"/post/"+data.posts[i].categoria+"/"+data.posts[i].slug+" ' class='btn btn-success' role='button'>Visualizar</a>";
          html += "</div>";
          html += "</div>";
        }

        if(data.posts.length!=0){
          $("#textos").html(html);
        }else{
          $('#qtde').html("Nenhum Texto Foi Encontrado!!!");
          $("#textos").html("");
        }
      });
    }
  });
</script>
@endsection
