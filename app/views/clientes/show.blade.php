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
              <a href={{ URL::to('cliente') }}>Cliente</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Clientes</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




 <div class="page-header position-relative">
        <h1>
 Clientes

</h1>
 </div><!--/.page-header-->
   
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
          <th>Rut</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Origen</th>
           <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($cliente as $cliente)
           <tr>
<td>{{ $cliente->rut}}</td>

<td>{{ $cliente->nombres}}</td>

<td> {{ $cliente->apellidop.' '.$cliente->apellidom }}</td>

<td> {{ $cliente->origen }} </td>

<td class="td-actions">                       
                        


                          <a class="green" href= {{ 'cliente/update/'.$cliente->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $cliente->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                       
     
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>


  <script type="text/javascript">


 $(document).ready(function() {

$( "#clienteactive" ).addClass( "active" );

var table = $('#example').DataTable( {
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
             $.get("{{ url('eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });




});
 </script>




        

        


@stop

