<?php
class ProductoController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
      
        $productos = Producto::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('productos.show')->with("productos",$productos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $producto = new Producto; 
        //enviamos un usuario vacio para que cargue el formulario insert

        $tarifas = Tarifa::all()->lists("nombre","id","stock");
        return View::make('productos.formulario')->with("producto",$producto)->with("tarifas",$tarifas);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $producto = new Producto;

        $datos = Input::all(); 
        
        if ($producto->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $producto->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $producto->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('ProductoController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('producto/insert')->withInput()->withErrors($producto->errors);
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
      
 
           $producto = Producto::find($id);
   
        return View::make('productos.formulario')->with("producto", $producto);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $producto = Producto::find($id);


        $datos = Input::all(); 
        
        if ($producto->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $producto->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $producto->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('ProductoController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('producto/insert')->withInput()->withErrors($producto->errors);
            //return "mal2";
        }

        return Redirect::to('producto');
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $producto = Producto::find($id);

        $producto->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>