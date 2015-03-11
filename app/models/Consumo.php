<?php
class Consumo extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'consumo';
   
   protected $fillable = array('cliente_id','consumo','ano','mes','lectura','estado','tipopago'); // los campos de la tabla




public function cliente(){
    return $this->belongsTo ("Cliente");
   }

    public $errors;
    
    public function isValid($data, $id) // funcion que valida los datos
    {
        $rules = array(
            'cliente_id' => 'required',
            
            'lectura' => 'required',
            
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