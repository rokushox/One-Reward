<?php

include_once 'RepositorioUsuario.inc.php';

class ValidadorRegistro {

    private $aviso_inicio; /* variables para poner los avisos de error sin copiarlo a cada rato */
    private $aviso_cierre;
    private $nombre;
    private $email;
    private $clave;
    private $error_nombre;
    private $error_email;
    private $error_clave1;
    private $error_clave2;

    public function __construct($nombre, $email, $clave1, $clave2, $conexion) { //la conexion porq necesitamos mirar en la base de datos si el nombre o email existe
        $this->aviso_inicio = " <br><div class='alert alert-danger' role='alert'>"; /* NO SE PUEDE PONER COMILLAS DOBLES, SIMPLES O NADA */
        $this->aviso_cierre = "</div>";
        $this->nombre = "";
        $this->email = "";

        $this->error_nombre = $this->validar_nombre($conexion, $nombre);
        $this->error_email = $this->validar_email($conexion, $email);
        $this->error_clave1 = $this->validar_clave1($clave1);
        $this->error_clave2 = $this->validar_clave2($clave1, $clave2);

        if ($this->error_clave1 === "" && $this->error_clave2 === "") { /* clave iniciada */
            $this->clave = $clave1;
        }
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_nombre($conexion, $nombre) {
        if (!$this->variable_iniciada($nombre)) {
            return "Debes escribir un nombre";
        } else {
            $this->nombre = $nombre;
        }
        if (strlen($nombre) < 3) {
            return "El nombre debe tener 3 caracteres como minimo";
        }
        if (strlen($nombre) > 24) {
            return "el nombre debe tener menos de 24 caracteres";
        }
        if (RepositorioUsuario::nombre_existe($conexion, $nombre)) {
            return "El nombre de usuario ya esta utilizado";
        }
        return "";
    }

    private function validar_email($conexion, $email) {
        if (!$this->variable_iniciada($email)) {
            return "debes escribir un email";
        } else {
            $this->email = $email;
        }
        if (RepositorioUsuario::email_existe($conexion, $email)) {
            return "El email ingresado ya fue utilizado, prueba con otro o <a href='#'>recupere su contraseña</a>";
        }
        return "";
    }

    private function validar_clave1($clave1) {
        if (!$this->variable_iniciada($clave1)) {
            return "debes escribir una contraseña";
        } else {
            if (strlen($clave1) < 6){
                return "La contraseña debe tener entre 6 a 30 caracteres";
            }
            if (strlen($clave1) > 30){
                return "La contraseña debe tener entre 6 a 30 caracteres";
            }
        }

        return "";
    }

    private function validar_clave2($clave1, $clave2) {
        if (!$this->variable_iniciada($clave1)) {
            return "Debes rellenar las dos contraseñas";
        }
        if (!$this->variable_iniciada($clave2)) {
            return "debes repetir la contraseña";
        } 
        
        if ($clave1 !== $clave2) {
            return "Ambas contraseñas deben coincidir";
        }
        return"";
    }

    public function obtener_nombre() {
        return $this->nombre;
    }

    public function obtener_email() {
        return $this->email;
    }

    public function obtener_clave() {
        return $this->clave;
    }

    public function obtener_error_nombre() {
        return $this->error_nombre;
    }

    public function obtener_error_email() {
        return $this->error_email;
    }

    public function obtener_error_clave1() {
        return $this->error_clave1;
    }

    public function obtener_error_clave2() {
        return $this->error_clave2;
    }

    public function mostrar_nombre() {
        if ($this->nombre !== "") {
            echo 'value="' . $this->nombre . '"';
        }
    }

    public function mostrar_error_nombre() {
        if ($this->error_nombre !== "") {
            echo $this->aviso_inicio . $this->error_nombre . $this->aviso_cierre;
        }
    }

    public function mostrar_email() {
        if ($this->email !== "") {
            echo 'value="' . $this->email . '"';
        }
    }

    public function mostrar_error_email() {
        if ($this->error_email !== "") {
            echo $this->aviso_inicio . $this->error_email . $this->aviso_cierre;
        }
    }

    public function mostrar_error_clave1() {
        if ($this->error_clave1 !== "") {
            echo $this->aviso_inicio . $this->error_clave1 . $this->aviso_cierre;
        }
    }

    public function mostrar_error_clave2() {
        if ($this->error_clave2 !== "") {
            echo $this->aviso_inicio . $this->error_clave2 . $this->aviso_cierre;
        }
    }

    public function registro_valido() {
        if ($this->error_nombre === "" &&
                $this->error_email === "" &&
                $this->error_clave1 === "" &&
                $this->error_clave2 === "") {
            return true;
        } else {
            return false;
        }
    }

}
