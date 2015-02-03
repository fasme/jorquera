<?php
class Cliente extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cliente';
   
   protected $fillable = array('tarifa_id','nombres','apellidop','apellidom','rut','origen','nmedidor','direccion','telefono'); // los campos de la tabla



    public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            'tarifa_id' => 'required',
            'nombres'     => 'required',
            'apellidop' => 'required',
            'apellidom' => 'required',
            'rut'     => 'required',
            'origen' => 'required',
            'nmedidor' => 'required',
            'direccion'     => 'required',
            'telefono' => 'required',
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }
    }
?>