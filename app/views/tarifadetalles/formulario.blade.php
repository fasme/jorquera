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
              <a href={{ URL::to('tarifadetalles') }}>Detalle</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Detalle de Tarifas</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Editar Detalle</h1>
  </div>
            <!--si el formulario contiene errores de validación-->
       <?php
  // si existe el usuario carga los datos
    if ($tarifadetalle->exists):
        $form_data = array('url' => 'tarifadetalle/update/'.$tarifadetalle->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'tarifadetalle/insert');
        $action    = 'Crear';        
    endif;

  //   {{Form ::select('tarifa',$tari,Input::old('tarifa'),$tarifadetalle->tarifa_id)}}

?>

            {{ Form::open($form_data) }}
        
            
            {{Form::label('tarifa', 'Tarifa')}}
            {{Form::select('tari',$tari,$tarifadetalle->tarifa_id)}}


             {{Form::label('tramoa', 'Tramo A (mt 3)')}}
            {{Form::text('tramoa', $tarifadetalle->tramoa)}}

             {{Form::label('tramob', 'Tramo B (mt 3)')}}
            {{Form::text('tramob', $tarifadetalle->tramob)}}

             {{Form::label('valor', 'Valor del Tramo')}}
            {{Form::text('valor', $tarifadetalle->valor)}}
           
            {{Form::submit('Guardar')}}
        {{ Form::close() }}





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





  <script type="text/javascript">


 $(document).ready(function() {

$( "#configuracionactive" ).addClass( "active" );

$( "#tarifadetalleactive" ).addClass( "active" );






});
 </script>



@stop