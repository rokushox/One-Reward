<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/RecuperacionClave.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioRecuperacionClave.inc.php';


$componentes_url = parse_url($_SERVER['REQUEST_URI']);
$ruta = $componentes_url['path'];

$partes_ruta = explode('/', $ruta);
$partes_ruta = array_filter($partes_ruta); //espacios vacios los convierte en null
$partes_ruta = array_slice($partes_ruta, 0); //borra los espacios nulos

$ruta_elegida = 'vistas/404.php';

if ($partes_ruta[0] == 'blog') {
    if (count($partes_ruta) == 1) {
        $ruta_elegida = 'vistas/home.php';
    } else if (count($partes_ruta) == 2) {
        switch ($partes_ruta[1]) {
            case 'login':
                $ruta_elegida = 'vistas/login.php';
                break;
            case 'logout':
                $ruta_elegida = 'vistas/logout.php';
                break;
            case 'registro':
                $ruta_elegida = 'vistas/registro.php';
                break;
            case 'estado-actual':
                $ruta_elegida = 'paneles/estado-actual.php';
                break;
            case 'perfil':
                $ruta_elegida = 'paneles/perfil.php';
                break;
            case 'objetos':
                $ruta_elegida = 'paneles/objetos.php';
                break;
            case 'habilidades':
                $ruta_elegida = 'paneles/habilidades.php';
                break;
            case 'viajar':
                $ruta_elegida = 'paneles/viajar.php';
                break;
            case 'explorar':
                $ruta_elegida = 'paneles/explorar.php';
                break;
            case 'entrenar':
                $ruta_elegida = 'paneles/entrenar.php';
                break;
            case 'buscar-enemigo':
                $ruta_elegida = 'paneles/buscar-enemigo.php';
                break;
            case 'misiones':
                $ruta_elegida = 'paneles/misiones.php';
                break;
            case 'historia':
                $ruta_elegida = 'paneles/historia.php';
                break;
            case 'tutorial':
                $ruta_elegida = 'paneles/tutorial.php';
                break;
            case 'soporte':
                $ruta_elegida = 'paneles/soporte.php';
                break;
            case 'recuperar-clave':
                $ruta_elegida = 'vistas/recuperar-clave.php';
                break;
            case 'generar-url-secreta':
                $ruta_elegida = 'scripts/generar-url-secreta.php';
        }
    } else if (count($partes_ruta) == 3) {
        if ($partes_ruta[1] == 'registro-correcto') {
            $nombre = $partes_ruta[2];
            $ruta_elegida = 'vistas/registro-correcto.php';
        }
    }
    if (count($partes_ruta) == 3) {
        if ($partes_ruta[1] == 'recuperacion-clave') {
            $url_personal = $partes_ruta[2];
            $ruta_elegida = 'vistas/recuperacion-clave.php';
        }
    }
}

include_once $ruta_elegida;
