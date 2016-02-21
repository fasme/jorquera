<?php
class TransaccionController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $transacciones = Transaccion::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('transacciones.show')->with("transaccion",$transacciones);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $transaccion = new Transaccion; 
        //enviamos un usuario vacio para que cargue el formulario insert
        $productos = Producto::all()->lists("nombre","id");

        return View::make('transacciones.formulario')->with("transaccion",$transaccion)->with("productos",$productos);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $transaccion = new Transaccion;

        $datos = Input::all(); 
        
        if ($transaccion->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario

            if($datos["tipotransaccion"] == 'salida')
            {
                $datos["cantidad"] = $datos["cantidad"] * -1; 
            }


            $transaccion->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      

           $transaccion->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('TransaccionController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('transaccion/insert')->withInput()->withErrors($transaccion->errors);
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
      
 
           $transaccion = Transaccion::find($id);
            $productos = Producto::all()->lists("nombre","id");
   
        return View::make('transacciones.formulario')->with("transaccion", $transaccion)->with("productos",$productos);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $transaccion = Transaccion::find($id);


        $datos = Input::all(); 
        
        if ($transaccion->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario

             if($datos["tipotransaccion"] == 'salida')
            {
                $datos["cantidad"] = $datos["cantidad"] * -1; 
            }
            
            $transaccion->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $transaccion->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('TransaccionController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('transaccion/insert')->withInput()->withErrors($transaccion->errors);
            //return "mal2";
        }

        return Redirect::to('transaccion');
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $transaccion = Transaccion::find($id);

        $transaccion->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>