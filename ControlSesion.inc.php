<?php

class ControlSesion {

    public static function iniciar_sesion($id_usuario, $nombre_usuario) {
        //$_SESSION es una serie de variables que se guardan en el servidor, cada vez que se entra en la pag con un navegador se le da un session a cada navegador conectado, para que guarde unos pequeños datos llamados cookies 
        if (session_id() == "") { //session_id es el id que se le da a cada session para diferenciarla automaticamente    
            session_start(); //habilita el espacio en la memoria del servidor, si la usamos 2 veces no pasa nada, pero mejor asegurarse con el if
        }
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['nombre_usuario'] = $nombre_usuario;
    }

    public static function cerrar_sesion() {
        if (session_id() == "") {
            session_start();
        }
        if (isset($_SESSION['id_usuario'])) { //si existe el id de usuario
            unset($_SESSION['id_usuario']);  //borramos con unset(), el id de usuario en este caso
        }
        if (isset($_SESSION['nombre_usuario'])) {
            unset($_SESSION['nombre_usuario']);
        }
        session_destroy(); //destruye el espacio de la memoria del servidor asi queda completamente en blanco
    }
    
    public static function sesion_iniciada(){
        if (session_id() == "") { //como siempre habilitamos el espacio del server
            session_start();
        }
        if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombre_usuario'])){
            return true;
        } else {
            return false;
        }
    }

}
