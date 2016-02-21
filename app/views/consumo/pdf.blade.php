<style>

.oli{
	
border: 1px solid black;
	 
}

table, th, td{

	
}


.letrachica { 
  font: 70% arial; 
}
}
</style>

<html>
<table width='100%' class='oli'>

	<tr>
<td rowspan="2"><img src='avatars/Copia de logo.png' width='150'></td>

		<td>
{{ "Boleta N ". $consumo->id  }}
</td>
	</tr>

	<tr><td>Periodo: {{$consumo->mes}} / {{$consumo->ano}}</td></tr>
	

</table>

<br>



<table width='100%' class='oli'>
	<tr>
<th class='oli' colspan='4'>{{ $consumo->cliente->nombres." ".$consumo->cliente->apellidop." ".$consumo->cliente->apellidom}}</th>
	</tr>



<tr>
<td>RUT</td><td>Direccion</td><td>Medidor</td><td>Tarifa</td>
</tr>

<tr>
<td>{{ $consumo->cliente->rut}}</td>
<td>{{ $consumo->cliente->direccion}}</td>
<td>{{ $consumo->cliente->rut}}</td>
<td>{{ $consumo->cliente->tarifa->nombre}}</td>
</tr>





</table>


<?php 
$consumoactual =0;
$totaltramos =0;
$terminar ="";
$cobroextra = 0;
$mes = $consumo->mes;
$ano = $consumo->ano;
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

@foreach($consumo->where("mes","=",$mesanterior)->where("ano","=",$anoanterior)->where("cliente_id",'=',$consumo->cliente->id)->get() as $anterior)

@endforeach

<div style="position: absolute;top: 200px; left: 0px; background-color: #F2F2F2">
<table width='30%' class='oli'>
<tr>
<td>Lectura Anterior</td><td>:</td><td>{{$anterior->lectura}}</td>
</tr>
<tr>
<td>Lectura Actual</td><td>:</td><td>{{$consumo->lectura}}</td>
</tr>
<tr>
<td>Consumo</td><td>:</td><td>{{$consumo->lectura - $anterior->lectura}}</td>
<?php 
$consumoactual = $consumo->lectura - $anterior->lectura;
?>
</tr>


</table>
 </div>


    @foreach ($consumo->cliente->tarifa->tarifadetalle()->get() as $valor)
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


    
 




<div style="position: absolute;top: 200px; left: 500px; background-color: #F2F2F2">
<table width='100%' class='oli'>
<tr>
<td>Cargo Fijo</td><td>:</td><td>$ {{$consumo->cliente->tarifa->cargofijo}}</td>
</tr>
<tr>
<td>Consumo de agua</td><td>:</td><td>{{$consumo->lectura - $anterior->lectura}}</td>
</tr>
<tr>
<td>Cobro del mes</td><td>:</td><td>$ {{$totaltramos}}</td>
</tr>
  <!--  CALCULAR COBROS EXTRAS  -->
    @foreach ($consumo->cliente->cobroextra as $cobrosextras)
 <?php 

 $cobroextra += $cobrosextras->valor;  
 //echo $cobrosextras->valor;
 echo "<tr><td>$cobrosextras->tipocobro</td><td>:</td><td>$ $cobrosextras->valor</td></tr>";

 ?>
    @endforeach



</table>
 </div>


 <div style="position: absolute;top: 400px; left: 300px; background-color: #F7F8E0">
<table width='100%' class='oli'>
<tr>
<td>TOTAL A PAGAR</td><td>:</td><td>$ {{$totaltramos + $consumo->cliente->tarifa->cargofijo + $cobroextra }} </td>
</tr>
<tr>
<td>VENCIMIENTO</td><td>:</td><td>28/{{$mes}}/{{$ano}}</td>
</tr>



</table>
 </div>



</html>