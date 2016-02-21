@extends('layouts.master')

@section('breadcrumb')
<ul class="breadcrumb">
            <li>
              <i class="icon-home home-icon"></i>
              <a href="#">Home</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>

            <li>
              <a href={{ URL::to('cobroextra') }}>Cobros Extras</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Cobros Extras</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Editar Cobros Extras</h1>
  </div>


                @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif

  
            <!--si el formulario contiene errores de validación-->
       <?php
  // si existe el usuario carga los datos
    if ($cobros->exists):
        $form_data = array('url' => 'cobroextra/update/'.$cobros->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'cobroextra/insert');
        $action    = 'Crear';        
    endif;


  $mes = date("n");

  $ano = date("Y");

    $meses = array("1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
$anos = array("2015"=>"2015","2016","2017","2018","2019","2020");

?>

            {{ Form::open($form_data) }}
        

        {{Form::label('Cliente', 'Cliente')}}
            {{Form::select('cliente_id',$clientes, $cobros->cliente_id, array("id"=>"clientes"))}}
            



            {{Form::label('Mes')}}
            {{Form::select("mes",$meses,$mes)}}

            {{Form::label('Año')}}
            {{Form::select("ano",$anos,$ano)}}

             {{Form::label('Tipo de cobro', 'Tipo de  cobro')}}
            {{Form::text('tipocobro', $cobros->tipocobro)}}
            <small>Multas, Inscripciones, Reposiciones</small>

            {{Form::label('valor', 'valor')}}
            {{Form::text('valor', $cobros->valor)}}

            
		
            
            {{Form::submit('Guardar')}}
        {{ Form::close() }}





 








  <script type="text/javascript">

 $(document).ready(function() {


$( "#cobroextraactive" ).addClass( "active" );
$("#clientes").chosen(); 




});


 </script>




@stop







