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


Cliente:
<h4>{{ $cliente->nombres." ".$cliente->apellidop." ".$cliente->apellidom }} </h4>


 <a class="red bootbox-dialog"  data-rel="tooltip" title="Cortar Servicio" href=<?php echo url('consumo/corte',  array("cliente_id"=>$cliente->id)); ?> >
                            <i class="fa fa-ban bigger-200"></i>
                          </a>


 <a class="green bootbox-dialog"  data-rel="tooltip" title="Pagar En cuotas" id="botoncuotas">
                            <i class="fa fa-cut bigger-200"></i>
                          </a>






<table id="example" class="table table-striped table-bordered table-hover">
<thead>
<th>Cuentas Pendientes</th><th>Valor</th><th>Periodo</th>
</thead>

 <tfoot>
            <tr>
                <th>Total:</th>
                <th></th>
                <th></th>
                
              
            </tr>
        </tfoot>

<?php
$sumatotal=0;
$pendientespost = array();
?>

@foreach($cliente->consumo()->where("estado","=","pendiente")->get() as $pendientes)


<?php 

$mes = $pendientes->mes;
$ano = $pendientes->ano;
$lecturamespasado =0;
$terminar = "";
$totaltramos =0;

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

<!-- lectura MES PASADO -->

@foreach($cliente->consumo()->where("ano","=", $anoanterior)->where("mes","=",$mesanterior)->get() as $lecturaanterior)


<?php
   $consumito = Consumo::find($lecturaanterior->id);
   $lecturamespasado = $consumito->lectura;
  $estadomespasado = $consumito->estado;

?>
@endforeach

    <!--  LECTURA MES ACTUAL  -->
@foreach($cliente->consumo()->where("ano","=", $ano)->where("mes","=",$mes)->get() as $lecturaactual2)
<?php 
 $lecturaactual2;
$consumito2 = Consumo::find($lecturaactual2->id);
$consumoid = $consumito2->id; 


  $lecturamesactual = $consumito2->lectura;
  $estadomesactual = $consumito2->estado;
 ?>

@endforeach





<!--  CALCULAR TOTAL CON TARIFAS -->
    @foreach ($cliente->tarifa->tarifadetalle()->get() as $valor)
<?php 
$consumoactual = $lecturamesactual - $lecturamespasado;

if($consumoactual>0)
{
    if(($consumoactual >= $valor->tramoa) && ($consumoactual <= $valor->tramob))
    {
     $totaltramos += ($consumoactual - ($valor->tramob-10))*$valor->valor;
    // break;
     $terminar = "termina";

    }
    else if($terminar != "termina")
    {
     $totaltramos += 10*$valor->valor;
    }


    
}
?>
  
      @endforeach



      <!--  CALCULAR COBROS EXTRAS  -->
 


    @foreach ($cliente->cobroextra as $cobrosextras)
 <?php 

 $totaltramos += $cobrosextras->valor;  
 //echo $cobrosextras->valor;

 ?>
    @endforeach




<!--  SUMAR CARGO FIJO  -->
    <?php
    $totaltramos += $cliente->tarifa->cargofijo;
    ?>




<?php
$sumatotal += $totaltramos;


echo "<tr><td>$pendientes->id</td><td>$totaltramos</td><td>$pendientes->mes / $pendientes->ano</td></tr>";

?>

@endforeach


</table>



<h4></h4>








<div id="divMostrarCuotas">
  <?php

  $meses = array("1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
$anos = array("2015"=>"2015","2016","2017","2018","2019","2020");

$meses2 = array('enero','febrero','marzo','abril','mayo','junio','julio',
               'agosto','septiembre','octubre','noviembre','diciembre');

$mes = date("m");
$ano = date("Y");

$form_data = array('url' => 'consumo/cuotas/'.$cliente->id);
  ?>

<div class="widget-box">
                    <div class="widget-header">
                      <h5>Ingresar Numero de cuotas</h5>

                     
                    </div>


                    <div class="widget-body">
                      <div class="widget-main">
                       
                         {{ Form::open($form_data) }}

                         
                          {{Form::label("Numero de cuotas")}}

                          {{Form::text("ncuota","")}}

                          {{Form::label("Total")}}
                          {{Form::text("total",$sumatotal)}}

                          {{Form::label("Fecha primer pago")}}

                          
            {{Form::select("mes",$meses,$mes)}}
            
            {{Form::select("ano",$anos,$ano)}}

                           {{Form::submit('Guardar')}}
        {{ Form::close() }}
                     
                       
                      </div>
                    </div>
</div>
</div>



  <script type="text/javascript">

 $(document).ready(function() {

  
  $('[data-rel=tooltip]').tooltip();


$( "#consumoactive" ).addClass( "active" );

$(".clientes").chosen(); 
$('.input-mask-date').mask('99/99/9999');

$("#divMostrarCuotas").hide();
$( "#botoncuotas" ).click(function()
  {
    $("#divMostrarCuotas").show();
  });



var table = $('#example').DataTable( {
  iDisplayLength: -1,
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "../js/TableTools/swf/copy_csv_xls_pdf.swf"
            
        },
         "footerCallback": function ( row, data, start, end, display ) {
      
          var api = this.api(), data;
     
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 1 )
                .data()
                .reduce( function (a, b) {
                    
                  //  alert(a + b);
                   // $.fn.dataTable.render.number( '\'', '.', 0, '$' );
                    return intVal(a) + intVal(b);

                } );
 
            // Total over this page
            pageTotal = api
                .column( 1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 1 ).footer() ).html(
                pageTotal
            );



            total = api
                .column( 1 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 1 ).footer() ).html(
                //''+pageTotal+' ($ '+ total+' total)'
                pageTotal
            );

           


         }
    } );




$("#lectura").keyup(function(){

var lecturaanterior = $("#lecturaanterior").val();
var lectura = $("#lectura").val();
var consumo = $("#lecturaanterior").val();

$("#consumo").val(parseFloat(lectura)-parseFloat(lecturaanterior));

});


});


 </script>




@stop







