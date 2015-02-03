<?php
class Tarifadetalle extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'tarifadetalle';
   
   protected $fillable = array('id','tarifa_id','tramoa','tramob','valor'); // los campos de la tabla



    public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
           // 'id'=> 'required',
            'tarifa_id' => 'required',
            'tramoa'     => 'required',
            'tramob' => 'required',
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