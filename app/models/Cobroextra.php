<?php
class Cobroextra extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cobroextra';
   
   protected $fillable = array('id','cliente_id', 'mes','ano','tipocobro','valor'); // los campos de la tabla



    public $errors;

    public function cliente(){
    return $this->belongsTo ("Cliente");
   }
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
            'valor'     => 'required',
            'tipocobro' => 'required',
			'mes' => 'required',
		    'ano' => 'required',
            
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