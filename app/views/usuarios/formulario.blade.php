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
              <a href={{ URL::to('usuarios') }}>Usuarios</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Usuarios</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Editar Usuario</h1>
  </div>
            <!--si el formulario contiene errores de validación-->
       <?php
  // si existe el usuario carga los datos
    if ($usuario->exists):
        $form_data = array('url' => 'usuarios/update/'.$usuario->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'usuarios/insert');
        $action    = 'Crear';        
    endif;

?>

            {{ Form::open($form_data) }}
        
        
            {{Form::label('nombre', 'Nombre')}}
            {{Form::text('nombre', $usuario->nombre)}}
            {{Form::label('apellido', 'Apellido')}}
            {{Form::text('apellido', $usuario->apellido)}}
            {{Form::label('nombre de usuario','nombre de usuario')}}
           {{Form::text('username',$usuario->username)}}
              @if($action == "Crear")
                {{Form::label('contraseña')}}
                {{Form::password('password')}}
              @endif 

            {{Form::label("Tipo de usuario")}}
            {{Form::select("tipousuario",array("1"=>"Administrador","2"=>"Usuario","3"=>"Operador"),$usuario->tipousuario)}}
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