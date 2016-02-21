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
              <a href={{ URL::to('productos') }}>Producto</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Productos</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Editar Producto</h1>
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
    if ($producto->exists):
        $form_data = array('url' => 'producto/update/'.$producto->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'producto/insert');
        $action    = 'Crear';        
    endif;

?>

            {{ Form::open($form_data) }}
        
            
            {{Form::label('nombre', 'Nombre')}}
            {{Form::text('nombre', $producto->nombre)}}
            
            
            {{Form::submit('Guardar')}}
        {{ Form::close() }}





 








  <script type="text/javascript">

 $(document).ready(function() {


$( "#bodegaactive" ).addClass( "active" );





});


 </script>




@stop







