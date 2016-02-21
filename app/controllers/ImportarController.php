<?php
class importarController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function import()
    {
      
       
        
     
        
        return View::make('importar.importar');
        
       
    }

    public function import2()
    {

         $file = Input::file("archivo");
    $file->move("archivo","datos.txt");


    foreach(file('archivo/datos.txt') as $line) {
    // loop with $line for each line of yourfile.txt

        $line = explode(",", $line);
        $tipoFila = $line[0];

        if($tipoFila == "CONSUMO")
        {
            $consumonuevo = new Consumo;
            $consumo = Consumo::where("id","=",$line[1]);
            
           

           if($consumo->count() == 0)
           {
                $data =  array("id"=>$line[1],"cliente_id"=>$line[2],"lectura"=>$line[3],"consumo"=>$line[4],"mes"=>$line[5],"ano"=>$line[6],"estado"=>$line[7],"tipopago"=>$line[8]);
                $consumonuevo->fill($data);
                $consumonuevo->save();
           }
            
            
        }
    }
    

return View::make("importar.importar")->with("mensaje", "Datos importados correctamente");

    }


    public function export()
    {

        $clientes = Cliente::all();
        $consumos = Consumo::all();
        
  
$contenido="";

foreach ($clientes as $cliente) {

$contenido = $contenido."CLIENTE,";  
$contenido = $contenido.$cliente->id.",";
$contenido = $contenido.$cliente->tarifa_id.",";
$contenido = $contenido.$cliente->nombres.",";
$contenido = $contenido.$cliente->apellidop.",";
$contenido = $contenido.$cliente->apellidom.",";
$contenido = $contenido.$cliente->rut.",";
$contenido = $contenido.$cliente->origen.",";
$contenido = $contenido.$cliente->nmedidor.",";
$contenido = $contenido.$cliente->direccion.",";
$contenido = $contenido.$cliente->telefono.",";
$contenido = $contenido.$cliente->orden.",";
$contenido = $contenido."\r\n";
}

foreach ($consumos as $consumo) {

$contenido = $contenido."CONSUMO,";  
$contenido = $contenido.$consumo->id.",";
$contenido = $contenido.$consumo->cliente_id.",";
$contenido = $contenido.$consumo->lectura.",";
$contenido = $contenido.$consumo->consumo.",";
$contenido = $contenido.$consumo->mes.",";
$contenido = $contenido.$consumo->ano.",";
$contenido = $contenido.$consumo->estado.",";

$contenido = $contenido."\r\n";
}

       $path = public_path('datos.txt');
    $file = File::put($path, $contenido);
    return Response::download($path);
    }




    public function importTablet()
    {

    return View::make("importar.importarTablet");

    }

    public function importTablet2()
    {

        $file = Input::file("archivo");
    $file->move("archivo","datos.txt");

 Consumo::truncate();
 Cliente::truncate();


    foreach(file('archivo/datos.txt') as $line) {
    // loop with $line for each line of yourfile.txt

        $line = explode(",", $line);
        $tipoFila = $line[0];
    



        if($tipoFila == "CLIENTE")
        {


            $cliente = new Cliente;

            $data = array("id"=>$line[1],"tarifa_id"=>$line[2],"nombres"=>$line[3],"apellidop"=>$line[4],"apellidom"=>$line[5],"rut"=>$line[6],"origen"=>$line[7],"nmedidor"=>$line[8],"direccion"=>$line[9],"telefono"=>$line[10],"orden"=>$line[11]);
             $cliente->fill($data);
             $cliente->save();
        }

        elseif($tipoFila == "CONSUMO")
        {
            $consumo = new Consumo;
            $data =  array("id"=>$line[1],"cliente_id"=>$line[2],"lectura"=>$line[3],"consumo"=>$line[4],"mes"=>$line[5],"ano"=>$line[6],"estado"=>$line[7],"tipopago"=>$line[8]);
             $consumo->fill($data);
             $consumo->save();
        }

       
}


    return View::make("importar.importarTablet")->with("mensaje", "Datos importados correctamente");
    }




 public function exportTablet()
    {

        $clientes = Cliente::all();
        $consumos = Consumo::all();
        
  
$contenido="";


foreach ($consumos as $consumo) {

$contenido = $contenido."CONSUMO,";  
$contenido = $contenido.$consumo->id.",";
$contenido = $contenido.$consumo->cliente_id.",";
$contenido = $contenido.$consumo->lectura.",";
$contenido = $contenido.$consumo->consumo.",";
$contenido = $contenido.$consumo->mes.",";
$contenido = $contenido.$consumo->ano.",";
$contenido = $contenido.$consumo->estado.",";

$contenido = $contenido."\r\n";
}

       $path = public_path('datosTablet.txt');
    $file = File::put($path, $contenido);
    return Response::download($path);
    }








}



?>