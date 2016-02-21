<?php
class InformeController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function sinServicio()
    {
        
        $clientes = Cliente::where("corte","=","si")->get();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('informe.sinservicio')->with("clientes",$clientes);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


 public function cuotas()
    {
        
        $cuotas = Cuota::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('informe.cuotas')->with("cuotas",$cuotas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }




 






}



?>