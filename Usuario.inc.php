<?php
/*Una clase es un objeto*/
class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $fecha_registro;
    private $activo;
    /* el private hace que nada pueda tocar/acceder a las variables, solo la clase que lo hace sola*/
    /*El constructor permite crear el usuario enpezando con unos ciertos datos*/
    
    public function __construct($id, $nombre, $email, $password, $fecha_registro, $activo){
        /*para que el constructor grabe los datos automaticamente en la clase hay que escribirlo, y para usar las variables
         *  que estan adentro de la clase en verde hay que usar el $this ->, sino es considerada una variable diferente
         */
        
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> email = $email;
        $this -> password = $password;
        $this -> fecha_registro = $fecha_registro;
        $this -> activo = $activo;
        /*el ATRIBUTO de la clase es igual a la variable del constructor, 
         * con el this diferenciamos las variable para que no se tomen como variables aleatorias, sino que son 
         * el atributo de la clase*/
        } /*hay que cerrar el construct y despues pner los getters*/
         
        /*getters: permite recuperar una variable(dato) de una clase*/
        
    /*parentesis vacios en los public porque no necesito que me den un dato, quiero ver uno que ya tengo*/
    
        
    public function obtener_id() {
        return $this -> id;   
    }
    public function obtener_nombre(){
        return $this -> nombre;
    }
    public function obtener_email(){
        return $this -> email;
    }
    public function obtener_password(){
        return $this -> password;
    }
    public function obtener_fecha_registro(){
        return $this -> fecha_registro;
    }
    public function esta_activo(){ /*"esta activo" porque es un boleano (verdadero o falso)*/
        return $this -> activo;
    }
    /*setters: permite cambiar el dato de una clase, sirve para cmabiar nick, mail, contraseña etc*/
    
    public function cambiar_nombre (){
        $this -> nombre;
    }
    public function cambiar_email (){
        $this -> email;
    }
    public function cambiar_password (){
        $this -> password;
    }
    public function cambiar_activo (){
        $this -> activo;
    }
    
    
    
    
    
        
        
        
        
        
        
    
}
