<?php
class ConsumotabletController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        
        $mes = date("n");
        $ano = date("Y");

       // $clientes = Cliente::join("consumo","consumo.cliente_id","=","cliente.id")->where("consumo.mes","=",$mes)->where("consumo.ano","=",$ano)->whereNotIn("consumo.lectura")->paginate(1);
        $clientes = Cliente::whereNotExists(function($query)
            {
                $mes = date("n");
                $ano = date("Y");
                $query->select(DB::raw(1))
                      ->from('consumo')
                      ->whereRaw('consumo.cliente_id = cliente.id')
                      ->whereRaw('consumo.mes ='.$mes)
                      ->whereRaw('consumo.ano ='.$ano);
                      
            })
            ->paginate(1);
            //->get();
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('consumotablet.show')->with("clientes",$clientes);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }





    public function insert2() //post
    {

        $datos = Input::all();
        $consumo = new Consumo;
       // print_r($data);

        if ($consumo->isValid($datos,""))
        {
        

             $primerconsumo = Consumo::where("cliente_id","=",$datos["cliente_id"])->count();

            $consumo->fill($datos);
            
            if($primerconsumo == 0) // si es el primer consumo, la boleta kedara pagada
            {
                $consumo->estado = "pagado";
            }
            
            $consumo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario


            return Redirect::to('consumoTablet')->with("success","Datos ingresados correctamente");
            
        }
        
      
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