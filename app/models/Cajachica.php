<?php
class Cajachica extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cajachica';
   
   protected $fillable = array('id','valor','tipotransaccion','tipopago','descripcion'); // los campos de la tabla



    public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
            'valor'     => 'required',
            'tipotransaccion' => 'required',
			'tipopago' => 'required',
		    'descripcion' => 'required',
            
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