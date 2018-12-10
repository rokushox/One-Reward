<?php

class ValidadorRecuperacion {

    private $aviso_inicio;
    private $aviso_cierre;
    private $clave;
    private $error_clave1;
    private $error_clave2;

    public function __construct($clave1, $clave2, $conexion) {


        $this->aviso_inicio = " <br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";

        $this->error_clave1 = $this->validar_clave1($clave1);
        $this->error_clave2 = $this->validar_clave2($clave1, $clave2);

        if ($this->error_clave1 === "" && $this->error_clave2 === "") { /* clave iniciada */
            $this->clave = $clave2;
        }
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_clave1($clave1) {
        if (!$this->variable_iniciada($clave1)) {
            return "debes escribir una contraseña";
        } else {
            if (strlen($clave1) < 6) {
                return "La contraseña debe tener entre 5 a 30 caracteres";
            }
            if (strlen($clave1) > 30) {
                return "La contraseña debe tener entre 5 a 30 caracteres";
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

    public function obtener_clave() {
        return $this->clave;
    }

    public function obtener_error_clave1() {
        return $this->error_clave1;
    }

    public function obtener_error_clave2() {
        return $this->error_clave2;
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

    public function mostrar_error() {
        if ($this->error !== '') {
            echo "<div class='alert alert-danger' role='alert'>";
            echo $this->error;
            echo "</div><br>";
        }
    }

    public function recuperacion_valida() {
        if (
                $this->error_clave1 === "" &&
                $this->error_clave2 === "") {
            return true;
        } else {
            return false;
        }
    }

}
