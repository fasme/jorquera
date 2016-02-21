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
              <a href={{ URL::to('producto') }}>Producto</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Productos</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




 <div class="page-header position-relative">
        <h1>
 Productos
<a class="btn  btn-success" href={{ url("producto/insert")}}>
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
          
            <th>Nombre</th>
           <th>Stock</th> 
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($productos as $producto)
           <tr>
<td>{{ $producto->nombre}}</td>
<td>{{ $producto->transaccion->sum("cantidad") }}</td>





<td class="td-actions">                       
                        


                          <a class="green" href= {{ 'producto/update/'.$producto->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $producto->id }}>
                            <i class="fa fa-trash bigger-130"></i>
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
             $.get("{{ url('producto/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });




});
 </script>




        

        


@stop

