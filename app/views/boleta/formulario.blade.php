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
              <a href={{ URL::to('clientes') }}>Consumo</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Consumo</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Consumo</h1>
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
    if ($consumo->exists):
        $form_data = array('url' => 'consumo/update/'.$consumo->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'consumo/insert');
        $action    = 'Crear';        
    endif;

?>

            {{ Form::open($form_data) }}
          
            {{Form::label('Cliente')}}
            {{Form::select('cliente_id', $clientes,$consumo->cliente_id, array("class"=>"clientes"))}}
            {{Form::label('Fecha')}}

            {{Form::text('fecha',  date_format(date_create($consumo->fecha),'d/m/Y')  , array("class"=>"input-mask-date"))}}
            <small class="text-success">dd/mm/yyyy</small>

            {{Form::label('Consumo')}}
            {{Form::text('consumo', $consumo->consumo)}}
            {{Form::submit('Guardar')}}
        {{ Form::close() }}





 








  <script type="text/javascript">

 $(document).ready(function() {


$( "#consumoactive" ).addClass( "active" );

$(".clientes").chosen(); 
$('.input-mask-date').mask('99/99/9999');




});


 </script>




@stop







