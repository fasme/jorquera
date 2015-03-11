
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
              <a href={{ URL::to('usuarios') }}>Usuarios</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Usuarios</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




 <div class="page-header position-relative">
        <h1>
  Usuarios
<a class="btn  btn-success" href={{ url("usuarios/insert")}}>
  <i class="fa fa-plus-circle fa-2x pull-left"></i> Añadir</a> 
</h1>
 </div><!--/.page-header-->
   
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Tipo de Usuario</th>
           <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($usuarios as $usuario)
           <tr><td>
    {{ $usuario->nombre.' '.$usuario->apellido }}
      
  </td>
  <td> {{ $usuario->username }}</td>
  <td>
  @if ($usuario->tipousuario == "1")
{{ "Administrador" }}
  @endif

  @if ($usuario->tipousuario == "2")
  {{ "Usuario" }}
  @endif

    </td>

  <td class="td-actions">
                       
                        


                          <a class="green" href= {{ 'usuarios/update/'.$usuario->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $usuario->id }}>
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
             $.get("{{ url('usuarios/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });




});
 </script>




        

        


@stop

