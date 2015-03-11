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
        <a class="btn  btn-success" href={{ url("consumo/insert")}}>
  <i class="fa fa-plus-circle fa-2x pull-left"></i> Añadir</a> 

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
  $mes = date("m");
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
$meses = array("1"=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$anos = array("2015"=>"2015","2016","2017","2018","2019","2020");
?>

            {{ Form::open(array('url' => 'consumo', "method"=>"get")) }}
        
            
            {{Form::label('Mes')}}
            {{Form::select("mes",$meses,$mes)}}
            {{Form::label('Año')}}
            {{Form::select("ano",$anos,$ano)}}
         
           
            {{Form::submit('Enviar')}}
        {{ Form::close() }}





 <table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
          <th>Rut</th>
            <th>Nombres</th>
            <th>Orden</th>
            <th>Consumo del mes seleccionado</th>
           <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>




  @foreach($clientes as $cliente)
           <tr>
<td>{{ $cliente->rut}}</td>

<td>{{ $cliente->nombres." ".$cliente->apellidop.' '.$cliente->apellidom }}</td>

<td> {{ $cliente->orden }} </td>
  <?php $consumomes ="";
  $consumoid = ""; ?>
@foreach($cliente->consumo()->whereRaw("EXTRACT(month FROM fecha) =". $mes)->whereRaw("EXTRACT(year FROM fecha) =". $ano)->get() as $consumo)
<?php $consumomes = $consumo->consumo; 
$consumoid = $consumo->id; ?>
@endforeach
<td>  {{ $consumomes }}  </td>



<td class="td-actions">                       
                        

        @if(is_numeric($consumoid))
                          <a class="green bootbox-dialog" href=<?php echo url('consumo/update',  array("id"=>$consumoid)); ?> >
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>
        @endif             
                          
                       
     
                      </td>
</tr>
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

$( "#consumoactive" ).addClass( "active" );

var table = $('#example').DataTable( {
  iDisplayLength: -1,
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "../js/TableTools/swf/copy_csv_xls_pdf.swf"
            
        }
    } ).makeEditable({
                    sUpdateURL: "editable.php"
                });





});
 </script>




@stop