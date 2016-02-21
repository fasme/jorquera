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
              <a href={{ URL::to('cajachica') }}>Cajachica</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Caja chica</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Editar Caja chica</h1>
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
    if ($cajachica->exists):
        $form_data = array('url' => 'cajachica/update/'.$cajachica->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'cajachica/insert');
        $action    = 'Crear';        
    endif;

?>

            {{ Form::open($form_data) }}
        
            {{Form::label('valor', 'valor')}}
            {{Form::text('valor', $cajachica->valor)}}
			{{Form::label('tipotransaccion', 'tipotransaccion')}}
            {{Form::select('tipotransaccion',array("entrada"=>"entrada", "salida"=>"salida"), $cajachica->tipotransaccion)}}
            {{Form::label('tipopago', 'tipopago')}}
           {{ Form::select("tipopago",array("efectivo"=>"efectivo","cheque"=>"cheque","transferencia"=>"transferencia"),"") }}

            {{Form::label('descripcion', 'descripcion')}}
            {{Form::text('descripcion', $cajachica->descripcion)}}
		
            
            {{Form::submit('Guardar')}}
        {{ Form::close() }}





 








  <script type="text/javascript">

 $(document).ready(function() {


$( "#cajachicaactive" ).addClass( "active" );





});


 </script>




@stop







