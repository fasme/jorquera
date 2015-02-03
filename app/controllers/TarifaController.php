<?php
class TarifaController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $tarifas = Tarifa::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('tarifas.show')->with("tarifa",$tarifas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $tarifa = new Tarifa; 
        //enviamos un usuario vacio para que cargue el formulario insert
        return View::make('tarifas.formulario')->with("tarifa",$tarifa);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

         $tarifa = new Tarifa;

        $datos = Input::all(); 
        
        if ($tarifa->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $tarifa->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $tarifa->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('TarifaController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('tarifa/insert')->withInput()->withErrors($tarifa->errors);
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
      
 
           $tarifa = Tarifa::find($id);
   
        return View::make('tarifas.formulario')->with("tarifa", $tarifa);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $tarifa = Tarifa::find($id);


        $datos = Input::all(); 
        
        if ($tarifa->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $tarifa->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $tarifa->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('TarifaController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('tarifa/insert')->withInput()->withErrors($tarifa->errors);
            //return "mal2";
        }

        return Redirect::to('tarifa');
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $tarifa = Tarifa::find($id);

        $tarifa->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>