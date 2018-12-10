<?php

/* en el repositorio se guardan todos los metodos correspondientes en este caso a los usuarios */

class RepositorioUsuario {

    public static function obtener_todos($conexion) { /* ponemos entre parentesis que vamos a utilizar la conexion con la DB */
        $usuarios = array(); /* hacemos una array de usuarios para que los guarde */

        if (isset($conexion)) { /* corroboramos si hay conexion por las dudas */
            try { /* siempre que pueda darse un error con algo hacerlo dentro de un try catch */
                include_once "Usuario.inc.php";
                $sql = ("SELECT * FROM usuarios"); /* codigo de sql el * significa todo, tambien recuperamos email y contraseña todo de los usuarios no discrimina ninguno tampoco */
                $sentencia = $conexion->prepare($sql); /* ponemos $sentencia porque estamos trabajando con DB PDO y le pedimos a conexion que ejecute el metodo "prepare" y adentro le ponemos el codigo ($sql) que queremos preparar */
                $sentencia->execute(); /* ESTE METODO EJECUTA LA SENTENCIA PREPARADA SQL, este metodo hace que se lea la db */
                $resultado = $sentencia->FetchAll(); /* la barra "\" sirve para que un caracter sea un caracter comun y no de programacion, prepare hace eso de forma automatica, fetchall significa que muestra todos los resultados la sentencia */
                if (count($resultado)) {
                    foreach ($resultado as $fila) { /* foreach recorre todo el array automaticamente, primero ponemos el array y despues como se van a llamar los indices */
                        $usuarios[] = new Usuario(
                                $fila["id"], $fila["nombre"], $fila["email"], $fila["password"], $fila["fecha_registro"], $fila["activo"]
                        );
                    }
                } else {
                    print "No hay usuarios ";
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $usuarios;
    }

    public static function obtener_numero_usuarios($conexion) {
        $total_usuarios = null; /* aca la creamos y despues le asignamos el numero */
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM usuarios"; /* count cuenta y "total" es el nombre que le asignamos a ese codigo sql */

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch(); /* solo fetch porque necesitamos que nos de 1 dato, no todos como antes */

                $total_usuarios = $resultado["total"]; /* resultado es una array, y total es un numero que lo manda count, ese numero pasa a ser $total_usuarios */
            } catch (PDOException $ex) {
                print "ERROR " . $ex->getMessage();
            }
        }
        return $total_usuarios;
    }

    public static function insertar_usuario($conexion, $usuario) {/* necesitamos 2 argumentos, la conec con la base de datos y el usuario que es el objeto que vamos a insertar */
        $usuario_insertado = false; /* creamos un boleano, porque cuando hacemos una operacion con pdo podemos obtener un boleano para saber si la operacion se hizo bien o no */
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO usuarios(nombre, email, password, fecha_registro, activo) VALUES(:nombre, :email, :password, NOW(), 0)"; /* INTO y despues el nombre de la tabla en el que vamos a insertar datos, adentro de la tabla ponemos en que columnas de esa tabla vamos a agregar datos */
                /* en "VALUE()" se ponen : y el nombre del dato para que los tome como "Alias" y pdo los maneje con cuidado automaticamente, el now es para que inserte la fecha de ese momento y el 0 para que este inactivo el usuario por si es un bot */
                $sentencia = $conexion->prepare($sql);
                /* bindParam = enlazar parametros, y asignamos cual va a ser el dato de cada alias el PDO::PARAM_STR indica que es texto */
                $nombretemp = $usuario->obtener_nombre();
                $emailtemp = $usuario->obtener_email();
                $passwordtemp = $usuario->obtener_password();

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $emailtemp, PDO::PARAM_STR);
                $sentencia->bindParam(':password', $passwordtemp, PDO::PARAM_STR);

                $usuario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuario_insertado; /* asi vemos si sale "true" se inserto bien el usuario o "false" no se inserto */
    }

    public static function nombre_existe($conexion, $nombre) {
        $nombre_existe = true; //creamos un boleano
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE nombre = :nombre"; //selecciona todos los datos de la DB donde nombre = :nombre
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR); //decimos que :nombre es igual al $nombre que inserta el usuario
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $nombre_existe = true;
                } else {
                    $nombre_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $nombre_existe;
    }

    public static function email_existe($conexion, $email) {
        $email_existe = true; //es igual al nombre_existe esta funcion
        if (isset($conexion)) {
            try {
                
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(":email", $email, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $email_existe = true;
                } else {
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $email_existe;
    }

    public static function obtener_usuario_por_email($conexion, $email) {
        $usuario = null;
        if (isset($conexion)) {
            try {
                include_once "Usuario.inc.php";
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'], $resultado['nombre'], $resultado['email'], $resultado['password'], $resultado['fecha_registro'], $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuario;
    }
        public static function obtener_usuario_por_id($conexion, $id) {
        $usuario = null;
        if (isset($conexion)) {
            try {
                include_once "Usuario.inc.php";
                $sql = "SELECT * FROM usuarios WHERE id = :id";
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'], $resultado['nombre'], $resultado['email'], $resultado['password'], $resultado['fecha_registro'], $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuario;
    }
    
    public static function actualizar_password($conexion, $id_usuario, $nueva_clave){
        $actualizacion_correcta = false;
        
        if(isset($conexion)){
            try {
                $sql = "UPDATE usuarios SET password = :password WHERE id = :id";
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> bindParam(':password', $nueva_clave, PDO::PARAM_STR);
                $sentencia -> bindParam(':id', $id_usuario, PDO::PARAM_STR);
                
                $sentencia-> execute();
                
                $resultado = $sentencia -> rowCount();
                if (($resultado) === 1){
                    $actualizacion_correcta = true;
                    
                } else {
                    $actualizacion_correcta = false;
                }
                
            } catch (PDOException $ex) {
                print 'ERROR' . $ex-> getMessage();
            }
        }
        return $actualizacion_correcta;
    }
    

}
