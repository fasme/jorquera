<?php
class Cuota extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cuota';
   
   protected $fillable = array('cliente_id','ncuota','valor','estado'); // los campos de la tabla



    public $errors;

    public function cliente(){
    return $this->belongsTo("Cliente");
   }

    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
            'valor'     => 'required'
            
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