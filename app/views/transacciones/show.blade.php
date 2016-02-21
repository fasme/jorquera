@extends('layouts.master')
 

@section('breadcrumb')
<ul class="breadcrumb">
            <li>
              <i class="icon-home home-icon"></i>
              <a href="#">Home</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-icon"></i>
              </span>
            </li>

            <li>
              <a href={{ URL::to('transaccion') }}>Transaccion</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Transaccion</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




 <div class="page-header position-relative">
        <h1>
 Transacciones
<a class="btn  btn-success" href={{ url("transaccion/insert")}}>
  <i class="fa fa-plus-circle fa-2x pull-left"></i> Añadir</a> 

</h1>
 </div><!--/.page-header-->


 @if(Session::get('success'))
<div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong></strong>
 
  {{Session::get('success')}}

</div>
@endif





<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
          <th>Producto</th>
            <th>Tipo de Transaccion</th>
            <th>Cantidad</th>
			<th>Valor</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($transaccion as $transaccion)
           <tr>

            <td>{{$transaccion->producto->nombre}}</td>
<td>{{ $transaccion->tipotransaccion}}</td>

<td>{{ $transaccion->cantidad}}</td>

<td>{{ $transaccion->valor}}</td>



<td class="td-actions">                       
                        


                          <a class="green" href= {{ 'transaccion/update/'.$transaccion->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                       
                       
     
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>


  <script type="text/javascript">


 $(document).ready(function() {

$( "#bodegaactive" ).addClass( "active" );

var table = $('#example').DataTable( {
        iDisplayLength: -1,
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "js/TableTools/swf/copy_csv_xls_pdf.swf"
            
        }
    } );


$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) {
             // bootbox.alert("You are sure!");
             tr.fadeOut(1000);
             $.get("{{ url('transaccion/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });




});
 </script>




        

        


@stop

