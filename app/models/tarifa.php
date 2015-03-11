<?php
class Tarifa extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'tarifa';
   
   protected $fillable = array('id','nombre','cargofijo'); // los campos de la tabla



public function cliente(){
    return $this->hasMany ("Cliente");
   }

    public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            //'id' => 'required',
            'nombre'     => 'required',
            'cargofijo' => 'required',
            
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