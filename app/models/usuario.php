<?php
class Usuario extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'usuario';
    protected $fillable = array('username','password','nombre','apellido','tipousuario'); // los campos de la tabla



    public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            'username' => 'required',
            'nombre'     => 'required',
            'apellido' => 'required'
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }


    //funcion para el editar usuario, de esta forma la contraseña no es enviada
    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = Hash::make($value);
        }
    }
}
?>