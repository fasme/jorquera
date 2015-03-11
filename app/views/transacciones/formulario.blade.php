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
              <a href={{ URL::to('transacciones') }}>Transaccion</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Transacciones</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Editar Transaccion</h1>
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
    if ($transaccion->exists):
        $form_data = array('url' => 'transaccion/update/'.$transaccion->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'transaccion/insert');
        $action    = 'Crear';        
    endif;

?>

            {{ Form::open($form_data) }}
        
            
            {{Form::label('producto_id', 'Producto')}}
            {{Form::text('producto_id', $transaccion->producto)}}
            {{Form::label('tipotransaccion', 'tipotransaccion')}}
            {{Form::text('tipotransaccion', $transaccion->tipotransaccion)}}
			{{Form::label('cantidad', 'cantidad')}}
            {{Form::text('cantidad', $transaccion->catidad)}}
			{{Form::label('valor', 'valor')}}
            {{Form::text('valor', $transaccion->valor)}}
            
            {{Form::submit('Guardar')}}
        {{ Form::close() }}





 








  <script type="text/javascript">

 $(document).ready(function() {


$( "#transaccionactive" ).addClass( "active" );





});


 </script>




@stop







