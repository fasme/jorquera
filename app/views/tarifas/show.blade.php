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
              <a href={{ URL::to('tarifa') }}>Tarifas</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Tarifas</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




 <div class="page-header position-relative">
        <h1>
 Tarifas

</h1>
 </div><!--/.page-header-->
   
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
          
            <th>Nombre</th>
            <th>Cargo Fijo</th>
            
           <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($tarifa as $tarifa)
           <tr>
<td>
    {{ $tarifa->nombre}}
      
  </td>
           <td>
    {{ $tarifa->cargofijo}}
      
  </td>
  

  <td class="td-actions">
                       
                        


                          <a class="green" href= {{ 'tarifa/update/'.$tarifa->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $tarifa->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                       
     
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>


  <script type="text/javascript">


 $(document).ready(function() {


$('#example').DataTable( {
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

