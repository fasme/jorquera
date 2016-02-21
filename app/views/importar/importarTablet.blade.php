@extends('layouts.masterTablet')

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
              <a href={{ URL::to('importar') }}>Importar</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Importar</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Importar Datos</h1>
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

  @if (isset($mensaje))
  <div class="alert alert-success">
    {{ $mensaje }}
</div>
  @endif

  
            <!--si el formulario contiene errores de validación-->
       <?php
  // si existe el usuario carga los datos
 
        $form_data = array('url' => 'importarTablet2', 'files' => true);
        $action    = 'Editar';


?>

            {{ Form::open($form_data) }}
        
            {{Form::label('archivo')}}
            {{Form::file('archivo')}}
			       
  
            
            {{Form::submit('Guardar')}}
        {{ Form::close() }}





 








  <script type="text/javascript">

 $(document).ready(function() {


$( "#cajachicaactive" ).addClass( "active" );





});


 </script>




@stop







