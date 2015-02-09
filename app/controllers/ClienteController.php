<?php
class ClienteController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $clientes = Cliente::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('clientes.show')->with("cliente",$clientes);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $cliente = new Cliente; 
        //enviamos un usuario vacio para que cargue el formulario insert

        $tarifas = Tarifa::all()->lists("nombre","id");
        return View::make('clientes.formulario')->with("cliente",$cliente)->with("tarifas",$tarifas);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $cliente = new Cliente;

        $datos = Input::all(); 
        
        if ($cliente->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $cliente->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $cliente->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('ClienteController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cliente/insert')->withInput()->withErrors($cliente->errors);
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
      
 
           $cliente = Cliente::find($id);
           $tarifas = Tarifa::all()->lists("nombre","id");
   
        return View::make('clientes.formulario')->with("cliente", $cliente)->with("tarifas",$tarifas);

                
 
      
    }


    public function update2($id) //post
    {
        
         $cliente = Cliente::find($id);


        $datos = Input::all(); 
        
        if ($cliente->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $cliente->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $cliente->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('ClienteController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cliente/insert')->withInput()->withErrors($cliente->errors);
            //return "mal2";
        }

        return Redirect::to('cliente');
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $cliente = Cliente::find($id);

        $cliente->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>