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
        $cliente_id = $consumo->cliente_id;  
        $mes = $consumo->mes;
        $ano = $consumo->ano;

    else:
        $form_data = array('url' => 'consumo/insert/');
        $action    = 'Crear';      

         
    endif;

?>

            {{ Form::open($form_data) }}
          
            {{Form::label('Cliente')}}
            {{Form::hidden('cliente_id', $cliente_id)}}
            <?php
             $cliente = Cliente::find($cliente_id); 
             echo "<h4 class='blue'> ".$cliente->nombres. " ". $cliente->apellidop." ".$cliente->apellidom."</h4>";
             ?>

         


            {{Form::label('Periodo')}}
           {{ Form::hidden("mes", $mes)}}
           {{ Form::hidden("ano", $ano)}}

          <h4 class='blue'> {{ $mes."/".$ano }} </h4>


            



            <?php
if($mes == 1)
{
  $mesanterior = 12;
  $anoanterior = $ano-1;
}
else
{
  $mesanterior = $mes-1;
  $anoanterior = $ano;
}

$lecturaanterior = 0;
            ?>


            @foreach($cliente->consumo()->where("ano","=", $anoanterior)->where("mes","=",$mesanterior)->get() as $lecturaanterior)
<?php 
$lecturaanterior = $lecturaanterior->lectura;
?>
@endforeach


			{{ Form::label("Tipo de pago")}}
           {{ Form::select("tipopago",array("efectivo"=>"efectivo","cheque"=>"cheque","transferencia"=>"transferencia"),"") }}


           {{ Form::hidden("estado","pagado")}}


           {{Form::hidden('lectura', $consumo->lectura)}}


            {{Form::submit('Guardar')}}
        {{ Form::close() }}





 








  <script type="text/javascript">

 $(document).ready(function() {


$( "#consumoactive" ).addClass( "active" );

$(".clientes").chosen(); 
$('.input-mask-date').mask('99/99/9999');

$("#lectura").keyup(function(){

var lecturaanterior = $("#lecturaanterior").val();
var lectura = $("#lectura").val();
var consumo = $("#lecturaanterior").val();

$("#consumo").val(parseFloat(lectura)-parseFloat(lecturaanterior));

});


});


 </script>




@stop







