<?php
class Tarifadetallecontroller extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $tarifadetalle = Tarifadetalle::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('tarifadetalles.show')->with("tarifadetalle",$tarifadetalle);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }




     public function insert()
    {
        $tarifadetalle = new Tarifadetalle; 
        //enviamos un usuario vacio para que cargue el formulario insert
        $tari = tarifa::lists('nombre','id');
 
    
        return View::make('tarifadetalles.formulario')->with("tarifadetalle",$tarifadetalle)->with('tari',$tari);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $tarifadetalle = new Tarifadetalle;


        $datos = Input::all(); 
        
        if ($tarifadetalle->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $tarifadetalle->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $tarifadetalle->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('tarifadetalleController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('tarifadetalle/insert')->withInput()->withErrors($tarifadetalle->errors);
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
      
 
           $tarifadetalle = Tarifadetalle::find($id);
   
        return View::make('tarifadetalles.formulario')->with("tarifadetalle", $tarifadetalle);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $tarifadetalle = Tarifadetalle::find($id);


        $datos = Input::all(); 
        
        if ($tarifadetalle->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $tarifadetalle->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $tarifadetalle->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('arifadetalleController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('tarifadetalle/insert')->withInput()->withErrors($tarifadetalle->errors);
            //return "mal2";
        }

        return Redirect::to('tarifadetalle');
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $tarifadetalle = Tarifadetalle::find($id);

        $tarifadetalle->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>