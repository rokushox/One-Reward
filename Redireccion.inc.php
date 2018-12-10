<?php

class redireccion{
    public static function redirigir ($url){ //unique resource location
        header ("Location: " . $url, true, 301); //html funciona con cabeceras que viajan cuando pedimos informacion al servidor, el codigo 301 significa redireccion true es para que se sobreescriba el url
        die(); //hace que la conexion se corte ahi, y si un bot nos visita no puede seguir leyendo mas, asi no hace cagadas
        
    }
}

