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
              <a href={{ URL::to('tarifadetalle') }}>Detalle de Tarifas</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Detalles de Tarifas</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




 <div class="page-header position-relative">
        <h1>
 Tarifas

</h1>
 </div><!--/.page-header-->
   
<div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong></strong>
  @if(Session::get('success'))
  {{Session::get('success')}}
  @endif
</div>

 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
          <th>Tarifa</th>
            <th>Tramo A</th>
            <th>Tramo B</th>
            <th>Valor</th>
            <th>SobreConsumo</th>
           <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
       
  @foreach($tarifadetalle as $tarifadetalles)
           <tr>
<td>
    {{ $tarifadetalles->tarifa->nombre}}
      
  </td>
           <td>
    {{ $tarifadetalles->tramoa}}
      
  </td>

           <td>
    {{ $tarifadetalles->tramob}}
      
  </td>

           <td>
    {{ $tarifadetalles->valor}}
      
  </td>

    <td>
    {{ $tarifadetalles->sobreconsumo}}
      
  </td>
  

  <td class="td-actions">
                       
                        


                          <a class="green" href= {{ 'tarifadetalle/update/'.$tarifadetalles->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $tarifadetalles->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                       
     
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>


  <script type="text/javascript">


 $(document).ready(function() {


$( "#configuracionactive" ).addClass( "active" );

$( "#tarifadetalleactive" ).addClass( "active" );


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
             $.get("{{ url('tarifadetalle/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });




});
 </script>





 


@stop

