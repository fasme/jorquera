<?php
class ConsumoController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $consumos = Consumo::all();
        $clientes = Cliente::all();
        $tarifas = Tarifa::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('consumo.show')->with("consumo",$consumos)->with("clientes",$clientes)->with("tarifas",$tarifas);
        
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
        

            $primerconsumo = Consumo::where("cliente_id","=",$datos["cliente_id"])->count();
         

            $consumo->fill($datos);
            
            if($primerconsumo == 0) // si es el primer consumo, la boleta kedara pagada
            {
                $consumo->estado = "pagado";
            }
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
        $html =  View::make("consumo.pdf")->with("consumo",$consumo);
//return $html;
      return PDF::load($html, 'A4', 'portrait')->show();
    }


    public function pagar($id)
    {
        $consumo = Consumo::find($id);

         


        return View::make('consumo.pagar')->with("consumo",$consumo);

    }

    public function pagar2($id)
    {
        $consumo = Consumo::find($id);

        $datos = Input::all();

        $datos["tipotransaccion"] = "entrada";
        $datos["descripcion"] = "pago cuenta mensual";
         $cajachica = new Cajachica;

         $cajachica->fill($datos);
         $cajachica->save();

         $consumo->estado = "pagado";
         $consumo->save();




       return Redirect::to('consumo');

    }


    public function pendientes($cliente_id)
    {

        $cliente = Cliente::find($cliente_id);
        return View::make('consumo.pendientes')->with("cliente",$cliente);
    }


    public function corte($cliente_id)
    {
        $cliente = Cliente::find($cliente_id);

        
        $cliente->corte = 'si';
        $cliente->save();

       return Redirect::to('consumo');
    }


     public function reposicion($cliente_id)
    {
        $cliente = Cliente::find($cliente_id);

        
        $cliente->corte = 'no';
        $cliente->save();

       return Redirect::to('informe/sinservicio');
    }



    public function cuotas($cliente_id)
    {
        $cliente = Cliente::find($cliente_id);
        return View::make('consumo.cuotas')->with("cliente",$cliente);
    }


    public function cuotas2($cliente_id)
    {
        $cliente = Cliente::find($cliente_id);

        $data = Input::all();

                

       

        $data2 = "";
        for($i=0;$i<$data["ncuota"];$i++)
        {
            $numcuota = $i+1;
            $cuota = new Cobroextra;
            $data2["cliente_id"] = $cliente_id;
            $data2["valor"] = $data["total"]/$data["ncuota"];
            $data2["ncuota"] = $numcuota;
            $data2["mes"] = $data["mes"];
            $data2["ano"] = $data["ano"];
            $data2["tipocobro"] = "Cuota Nº ".$numcuota." de ".$data["ncuota"];

            $cuota->fill($data2); 
            $cuota->save();

            $data["mes"]++;

            if($data["mes"] > 12)
        {
          $data["mes"] = 1;
          $data["ano"] = $data["ano"] + 1;
        }

        }
        //return "holi";


        $consumos = Consumo::where("estado","=","pendiente")->where("cliente_id","=",$cliente_id)->get();

        foreach ($consumos as $consumo) {
            $consumo->estado = "pagado";
            $consumo->save();
        }

        return Redirect::to('consumo');
    }



 






}



?>