<?php
class CajachicaController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
      
        $cajaschicas = Cajachica::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('cajaschicas.show')->with("cajaschicas",$cajaschicas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $cajachica = new Cajachica; 
        //enviamos un usuario vacio para que cargue el formulario insert

        $tarifas = Tarifa::all()->lists("id","valor","tipotransaccion","tipopago","descripcion");
        return View::make('cajaschicas.formulario')->with("cajachica",$cajachica)->with("tarifas",$tarifas);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $cajachica = new Cajachica;

        $datos = Input::all(); 
        
        if ($cajachica->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $cajachica->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $cajachica->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('CajachicaController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cajachica/insert')->withInput()->withErrors($cajachica->errors);
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
      
 
           $cajachica = Cajachica::find($id);
   
        return View::make('cajaschicas.formulario')->with("cajachica", $cajachica);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $cajachica = Cajachica::find($id);


        $datos = Input::all(); 
        
        if ($cajachica->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $cajachica->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $cajachica->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('CajachicaController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cajachica/insert')->withInput()->withErrors($cajachica->errors);
            //return "mal2";
        }

        return Redirect::to('cajachica');
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $cajachica = Cajachica::find($id);

        $cajachica->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>