<?php
class Producto extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'producto';
   
   protected $fillable = array('id','nombre','stock'); // los campos de la tabla



    public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
            'nombre'     => 'required',
            'stock' => 'required',
            
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