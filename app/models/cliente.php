<?php
class Cliente extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cliente';
   
   protected $fillable = array('tarifa_id','nombres','apellidop','apellidom','rut','origen','nmedidor','direccion','telefono','orden'); // los campos de la tabla

//rotected $connection = 'consumoDB';

   public function consumo(){
    return $this->hasMany("Consumo");
   }

   public function cobroextra(){
    return $this->hasMany("Cobroextra");
   }

   public function tarifa()
   {
    return $this->belongsTo("Tarifa");
   }

    public $errors;
    
    public function isValid($data, $id) // funcion que valida los datos
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
            'orden' => 'required|unique:cliente,orden,'.$id,
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