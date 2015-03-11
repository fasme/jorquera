<?php
class Transaccion extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'transaccion';
   
   protected $fillable = array('producto_id','tipotransaccion','cantidad','valor'); // los campos de la tabla



    public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            'producto_id' => 'required',
            'tipotransaccion'     => 'required',
            'cantidad' => 'required',
			'valor' => 'required',
            
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