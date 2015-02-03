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
              <a href={{ URL::to('tarifas') }}>Tarifas</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Tarifas</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Editar Tarifa</h1>
  </div>
            <!--si el formulario contiene errores de validación-->
       <?php
  // si existe el usuario carga los datos
    if ($tarifa->exists):
        $form_data = array('url' => 'tarifa/update/'.$tarifa->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'tarifa/insert');
        $action    = 'Crear';        
    endif;

?>

            {{ Form::open($form_data) }}
        
            
            {{Form::label('nombre', 'Nombre')}}
            {{Form::text('nombre', $tarifa->nombre)}}
            {{Form::label('cargofijo', 'Cargo Fijo')}}
            {{Form::text('cargofijo', $tarifa->cargofijo)}}
           
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

@stop