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
              <a href={{ URL::to('clientes') }}>Cliente</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Clientes</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Editar Cliente</h1>
  </div>
            <!--si el formulario contiene errores de validación-->
       <?php
  // si existe el usuario carga los datos
    if ($cliente->exists):
        $form_data = array('url' => 'cliente/update/'.$cliente->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'cliente/insert');
        $action    = 'Crear';        
    endif;

?>

            {{ Form::open($form_data) }}
        
            {{Form::label('tarifa_id', 'Tarifa')}}
            {{Form::select('tarifa_id', $tarifas,$cliente->tarifa_id)}}
            {{Form::label('nombre', 'Nombre')}}
            {{Form::text('nombres', $cliente->nombres)}}
            {{Form::label('apellidop', 'Apellido Paterno')}}
            {{Form::text('apellidop', $cliente->apellidop)}}
            {{Form::label('apellidom', 'Apellido Materno')}}
            {{Form::text('apellidom', $cliente->apellidom)}}
            {{Form::label('rut','Rut')}}
           {{Form::text('rut',$cliente->rut)}}
           {{Form::label('origen', 'Origen')}}
            {{Form::text('origen', $cliente->origen)}}
            {{Form::label('nmedidor', 'Numero medidor')}}
            {{Form::text('nmedidor', $cliente->nmedidor)}}
            {{Form::label('direccion', 'Direccion')}}
            {{Form::text('direccion', $cliente->direccion)}}
            {{Form::label('telefono', 'Telefono')}}
            {{Form::text('telefono', $cliente->telefono)}}
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


$( "#clienteactive" ).addClass( "active" );





});


 </script>




@stop







