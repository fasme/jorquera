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

$meses2 = array('enero','febrero','marzo','abril','mayo','junio','julio',
               'agosto','septiembre','octubre','noviembre','diciembre');
?>

            {{ Form::open(array('url' => 'consumo', "method"=>"get")) }}
        
            
            {{Form::label('Mes')}}
            {{Form::select("mes",$meses,$mes)}}
            {{Form::label('Año')}}
            {{Form::select("ano",$anos,$ano)}}
         
           
            {{Form::submit('Enviar')}}
        {{ Form::close() }}



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


 <table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
          <th>Rut</th>
            <th>Nombres</th>
            <th>Orden</th>
            <th>Lectura {{ $meses[$mesanterior] }}</th>
            <th>Lectura {{ $meses[$mes] }}</th>
            <th>Consumo</th>
            <th>Total $</th>
           <th>Acciones</th>
            
          </tr>
        </thead>


       


        <tbody>




  @foreach($clientes as $cliente)


           <tr>
<td>{{ $cliente->rut}}</td>

<td>{{ $cliente->nombres." ".$cliente->apellidop.' '.$cliente->apellidom }}</td>

<td> {{ $cliente->orden }} </td>

<td>

<!--  LESCTURA MES ANTERIOR  -->
@foreach($cliente->consumo()->where("ano","=", $anoanterior)->where("mes","=",$mesanterior)->get() as $lecturaanterior)


<?php
   $consumito = Consumo::find($lecturaanterior->id);
  echo $lecturamespasado = $consumito->lectura;
  $estadomespasado = $consumito->estado;

?>
@endforeach
</td>


  <?php
   $lecturaactual ="";
  $consumoid = ""; ?>
  
  <td>
    <!--  LECTURA MES ACTUAL  -->
@foreach($cliente->consumo()->where("ano","=", $ano)->where("mes","=",$mes)->get() as $lecturaactual2)
<?php 
 $lecturaactual2;
$consumito2 = Consumo::find($lecturaactual2->id);
$consumoid = $consumito2->id; 


 echo $lecturamesactual = $consumito2->lectura;
  $estadomesactual = $consumito2->estado;
 ?>

@endforeach
  </td>


  <td>
    <?php 

$consumoactual = $lecturamesactual - $lecturamespasado;
echo $consumoactual;
    ?>

  </td>


  <td> 

<?php
$totaltramos =0;
$terminar = "";


?>


<!--  CALCULAR TOTAL CON TARIFAS -->
    @foreach ($cliente->tarifa->tarifadetalle()->get() as $valor)
<?php 

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

     {{ $totaltramos }}
   </td>

<td class="td-actions">                       
                        

        @if(is_numeric($consumoid))
                          <a class="green bootbox-dialog"  data-rel="tooltip" title="Editar" href=<?php echo url('consumo/update',  array("id"=>$consumoid)); ?> >
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>
                            @if($lecturamespasado >0)
                   
                          <a class="red bootbox-dialog" data-rel="tooltip" title="Generar Boleta" target="_blank" href=<?php echo url('consumo/pdf',  array("id"=>$consumoid)); ?> >
                            <i class="fa fa-file-pdf-o bigger-130"></i>
                          </a>
                          @endif

                          @if(($estadomespasado == "pagado") && ($estadomesactual == "pendiente"))
                          <a class="green bootbox-dialog"  data-rel="tooltip" title="Pagar" href=<?php echo url("consumo/pagar", array("id"=>$consumoid)); ?> >
                                              <i class="fa fa-money bigger-130"></i>
                                            </a>

                          @elseif ($estadomesactual == "pagado")
                          <a class="green bootbox-dialog"  data-rel="tooltip" title="Pagada"  >
                                              <i class="fa fa-check bigger-130"></i>
                                            </a>

                          @elseif ($estadomespasado == "pendiente")
                          <a class="red bootbox-dialog"  data-rel="tooltip" title="Cuentas pendientes" href=<?php echo url("consumo/pendientes", array("cliente_id"=>$cliente->id)); ?> >
                                              <i class="fa fa-close bigger-130"></i>
                                            </a>

                          @endif



        @else
        <a class="green bootbox-dialog"  data-rel="tooltip" title="Agregar" href=<?php echo url("consumo/insert", array("mes"=>$mes,"ano"=>$ano,"cliente_id"=>$cliente->id)); ?> >
                            <i class="fa fa-plus bigger-130"></i>
                          </a>




        @endif          


        

        
                          
                       
     
                      </td>
</tr>

<?php
$lecturamespasado =0;
?>
          @endforeach
        </tbody>
  </table>


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
            "sSwfPath": "js/TableTools/swf/copy_csv_xls_pdf.swf"
            
        }
    } );





});
 </script>




@stop