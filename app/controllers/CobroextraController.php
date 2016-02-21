<?php
class CobroextraController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
      
        $cobros = Cobroextra::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('cobroextra.show')->with("cobros",$cobros);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $cobros = new Cobroextra; 
        //enviamos un usuario vacio para que cargue el formulario insert
        $clientes = Cliente::all()->lists("rut","id");
        //$tarifas = Tarifa::all()->lists("id","valor","tipotransaccion","tipopago","descripcion");
        return View::make('cobroextra.formulario')->with("cobros",$cobros)->with("clientes",$clientes);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $cobro = new Cobroextra;

        $datos = Input::all(); 
        
        if ($cobro->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $cobro->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $cobro->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('CobroextraController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cobroextra/insert')->withInput()->withErrors($cobro->errors);
            //return "mal2";
        }
     //   return Redirect::to('usuarios');
    // el método redirect nos devuelve a la ruta de mostrar la lista de los usuarios
 
    }
 
     /**
     * Ver usuario con id
     */

    public function update($id) //get
    {
        //echo $id;
      
 
           $cobros = Cobroextra::find($id);
           $clientes = Cliente::all()->lists("rut","id");
   
        return View::make('cobroextra.formulario')->with("cobros", $cobros)->with("clientes",$clientes);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $cobro = Cobroextra::find($id);


        $datos = Input::all(); 
        
        if ($cobro->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $cobro->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $cobro->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('CobroextraController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cobroextra/insert')->withInput()->withErrors($cobro->errors);
            //return "mal2";
        }

        return Redirect::to('cobroextra');
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $cobro = CobroExtra::find($id);

        $cobro->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>