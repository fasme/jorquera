<?php
class ConsumotabletController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $consumos = Consumo::all();
        $clientes = Cliente::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('consumotablet.show')->with("consumo",$consumos)->with("clientes",$clientes);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }



    public function insert0()
    {
       // return View::make('consumo.formulario0');

$consumo = new Consumo; 
        $clientes = Cliente::all();
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('consumotablet.formulario0')->with("consumo",$consumo)->with("clientes",$clientes);

    }


     public function insert()
    {
        $consumo = new Consumo; 
        $clientes = Cliente::lists("rut","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('consumotablet.formulario')->with("consumo",$consumo)->with("clientes",$clientes);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {


        $consumo = new Consumo;


        $datos = Input::all(); 

      
       
        if ($consumo->isValid($datos,""))
        {
             list($dia,$mes,$ano) = explode("/",$datos['fecha']);
            $datos['fecha'] = "$ano-$mes-$dia";
           

            $consumo->fill($datos);
            
            $consumo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::to('consumo')->with("success","Datos ingresados correctamente");
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('consumo/insert')->withInput()->withErrors($consumo->errors);
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
      
            $consumo =  Consumo::find($id);
            $clientes = Cliente::lists("rut","id");
           
   
        return View::make('consumo.formulario')->with("consumo", $consumo)->with("clientes",$clientes);

                
 
      
    }


    public function update2($id) //post
    {
        
         $cliente = Cliente::find($id);


        $datos = Input::all(); 
        
        if ($cliente->isValid($datos, $id))
        {
            // Si la data es valida se la asignamos al usuario
            $cliente->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $cliente->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
             return Redirect::to('consumo')->with("success","Datos ingresados correctamente");
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('consumo/insert')->withInput()->withErrors($cliente->errors);
            //return "mal2";
        }

        return Redirect::to('consumo');
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $cliente = Cliente::find($id);

        $cliente->delete();

    //return Redirect::to('usuarios/insert');
    }

    public function editable()
    {

        echo "wena";
    }



 






}



?>