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




<div style="position: absolute;top: 200px; left: 0px;">
<table width='30%' class='oli'>
<tr>
<td>Lectura Anterior</td><td>:</td><td>10</td>
</tr>
<tr>
<td>Lectura Actual</td><td>:</td><td>20</td>
</tr>
<tr>
<td>Consumo</td><td>:</td><td>50</td>
</tr>


</table>
 </div>




<div style="position: absolute;top: 200px; left: 500px;">
<table width='100%' class='oli'>
<tr>
<td>Cargo Fijo</td><td>:</td><td>10</td>
</tr>
<tr>
<td>Consumo de agua</td><td>:</td><td>20</td>
</tr>
<tr>
<td>Cobro del mes</td><td>:</td><td>50</td>
</tr>


</table>
 </div>


 <div style="position: absolute;top: 500px; left: 500px;">
<table width='100%' class='oli'>
<tr>
<td>TOTAL A PAGAR</td><td>:</td><td>10</td>
</tr>
<tr>
<td>VENCIMIENTO</td><td>:</td><td>20</td>
</tr>



</table>
 </div>



</html>