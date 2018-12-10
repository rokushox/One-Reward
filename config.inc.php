<?php
/*la informacion de config se utiliza para acceder a la base de datos 
 * (pide esta info para que solo nosotros podamos acceder como admins.*/


    /*antes usabamos variables, ahora constantes para eso usamos el metodo define, las constantes son mas persistentes y permanentes que las variables*/
//info base de datos
define("NOMBRE_SERVIDOR", "localhost");
define("NOMBRE_USUARIO", "root");
define("PASSWORD", "");
define("NOMBRE_BD", "blog");

//rutas de la web
define("SERVIDOR", "http://localhost/blog");
define("RUTA_REGISTRO", SERVIDOR."/registro");
define("RUTA_REGISTRO_CORRECTO", SERVIDOR."/registro-correcto");
define("RUTA_LOGIN", SERVIDOR."/login");
define("RUTA_LOGOUT", SERVIDOR."/logout");
define("RUTA_ESTADO_ACTUAL", SERVIDOR."/estado-actual");
define("RUTA_PERFIL", SERVIDOR."/perfil");
define("RUTA_OBJETOS", SERVIDOR."/objetos");
define("RUTA_HABILIDADES", SERVIDOR."/habilidades");
define("RUTA_VIAJAR", SERVIDOR."/viajar");
define("RUTA_EXPLORAR", SERVIDOR."/explorar");
define("RUTA_ENTRENAR", SERVIDOR."/entrenar");
define("RUTA_BUSCAR_ENEMIGO", SERVIDOR."/buscar-enemigo");
define("RUTA_MISIONES", SERVIDOR."/misiones");
define("RUTA_HISTORIA", SERVIDOR."/historia");
define("RUTA_TUTORIAL", SERVIDOR."/tutorial");
define("RUTA_SOPORTE", SERVIDOR."/soporte");
define("RUTA_RECUPERAR_CLAVE", SERVIDOR."/recuperar-clave");
define("RUTA_GENERAR_URL_SECRETA", SERVIDOR."/generar-url-secreta");
define("RUTA_RECUPERACION_CLAVE", SERVIDOR."/recuperacion-clave");
define("DIRECTORIO_RAIZ", realpath(__DIR__. "/.."));

//recursos
define("RUTA_CSS", SERVIDOR. "/css/");
define("RUTA_JS", SERVIDOR. "/js/");
