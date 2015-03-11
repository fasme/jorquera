<?php
class ConsumoController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $consumos = Consumo::all();
        $clientes = Cliente::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('consumo.show')->with("consumo",$consumos)->with("clientes",$clientes);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }




     public function insert($mes, $ano, $cliente_id)
    {
        $consumo = new Consumo; 
        
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('consumo.formulario')->with("consumo",$consumo)->with("ano",$ano)->with("mes",$mes)->with("cliente_id",$cliente_id);
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
        

            $consumo->fill($datos);
            
            $consumo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::to('consumo')->with("success","Datos ingresados correctamente");
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('consumo/insert/'.$datos["mes"]."/".$datos["ano"]."/".$datos["cliente_id"])->withInput()->withErrors($consumo->errors);
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
         
           
   
        return View::make('consumo.formulario')->with("consumo", $consumo);

                
 
      
    }


    public function update2($id) //post
    {
        
         $consumo = Consumo::find($id);


        $datos = Input::all(); 
        
        if ($consumo->isValid($datos, $id))
        {
            // Si la data es valida se la asignamos al usuario
            $consumo->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $consumo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
             return Redirect::to('consumo')->with("success","Datos ingresados correctamente");
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
//return Redirect::to('consumo/insert')->withInput()->withErrors($consumo->errors);
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



        public function pdf($id)
    {

        $consumo = Consumo::find($id);
        $html =  View::make("boleta.pdf")->with("consumo",$consumo);

      return PDF::load($html, 'A4', 'portrait')->show();
    }


    public function pagar($id)
    {
        $consumo = Consumo::find($id);

      

        return View::make('consumo.pagar')->with("consumo",$consumo);

    }



 






}



?>