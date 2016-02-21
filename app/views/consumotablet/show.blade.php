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
              <a href={{ URL::to('consumo') }}>Consumo</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Consumo</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')
<div class="page-header position-relative">
      <h1>Consumo 
  <!--      <a class="btn  btn-success" href={{ url("consumo/insert")}}>
  <i class="fa fa-plus-circle fa-2x pull-left"></i> Añadir</a>  -->

</h1>

      

  </div>
            <!--si el formulario contiene errores de validación-->

            <?php 
if (Input::has('mes'))
{
  $mes = Input::get('mes');
}
else
{
  $mes = date("n");
}

if (Input::has('mes'))
{
  $ano = Input::get('ano');
}
else
{
  $ano = date("Y");
}


?>


<?php
$meses = array("1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
$anos = array("2015"=>"2015","2016","2017","2018","2019","2020");

$meses2 = array("",'enero','febrero','marzo','abril','mayo','junio','julio',
               'agosto','septiembre','octubre','noviembre','diciembre');
?>

<!--
            {{ Form::open(array('url' => 'consumo', "method"=>"get")) }}
        
            
            {{Form::label('Mes')}}
            {{Form::select("mes",$meses,$mes)}}
            {{Form::label('Año')}}
            {{Form::select("ano",$anos,$ano)}}
         
           
            {{Form::submit('Enviar')}}
        {{ Form::close() }}
-->


<?php 
$lecturaanterior ="";
$consumito = "";
$consumito2 = "";
$consumito3 = "";
$lecturamespasado="";
$lecturamesactual="";
$estadomespasado = "";
$estadomesactual ="";

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
?>




{{ Form::open(array('url' => 'consumoTablet/insert')) }}

  @foreach($clientes as $cliente)

{{ Form::hidden("mes", $mes)}}
           {{ Form::hidden("ano", $ano)}}
           {{Form::hidden('cliente_id', $cliente->id)}}

<div class="widget-box pricing-box">
                    <div class="widget-header header-color-orange">
                      <h5 class="bigger lighter"> {{  $meses2[$mes] ." del ". $ano }}</h5>
                    </div>

                    <div class="widget-body">
                      <div class="widget-main">
                        <ul class="unstyled spaced2">
                          <li>
                            <i class="icon-ok green"></i>
                            <strong>RUT:</strong> {{ $cliente->rut}}
                          </li>

                          <li>
                            <i class="icon-ok green"></i>
                           <strong>Nombre:</strong> {{ $cliente->nombres." ".$cliente->apellidop.' '.$cliente->apellidom }}
                          </li>

                          <li>
                            <i class="icon-ok green"></i>
                            <strong> Orden: </strong> {{ $cliente->orden }} 
                          </li>

                          <li>
                            <i class="icon-ok green"></i>

                            <strong>Lectura mes anterior: </strong>

                            @foreach($cliente->consumo()->where("ano","=", $anoanterior)->where("mes","=",$mesanterior)->get() as $lecturaanterior)


<?php

 
  $consumito = Consumo::find($lecturaanterior->id);
  echo $lecturamespasado = $consumito->lectura;
  $estadomespasado = $consumito->estado;

?>
@endforeach
                          </li>

                          <li>
                            <i class="icon-ok green"></i>
                           

                            <?php
   $lecturaactual ="";
  $consumoid = ""; ?>
  
 <strong>Lectura mes Actual: </strong>
 {{ Form::text("lectura","")}}
@foreach($cliente->consumo()->where("ano","=", $ano)->where("mes","=",$mes)->get() as $lecturaactual2)
<?php 
/*
NO  MUESTRO LA LECTURA DEL MES ACTUAL, YA QUE SOLO SE MOSTRARAN LOS  CLIENTES QUE NO TENGAN CONSUMO
$consumito2 = Consumo::find($lecturaactual2->id);
$consumoid = $consumito2->id; 


 echo $lecturamesactual = $consumito2->lectura;
 $estadomesactual = $consumito2->estado;
 */
 ?>

@endforeach


                          </li>

                          <li>
                            <i class="icon-ok green"></i>
          <strong>Consumo: </strong>                
{{ $lecturamesactual - $lecturamespasado}}

                          </li>
                        </ul>

                        <hr />
                       
                      </div>

                      <div>
                        {{ Form::submit("Enviar", array("class"=>"btn btn-small btn-success"))}}
                        </a>
                      </div>
                    </div>
                  </div>
           


          @endforeach
 
{{ $clientes->links() }}


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

  $('[data-rel=tooltip]').tooltip();

$( "#consumoactive" ).addClass( "active" );

var table = $('#example').DataTable( {
  iDisplayLength: -1,
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "../js/TableTools/swf/copy_csv_xls_pdf.swf"
            
        }
    } );





});
 </script>




@stop