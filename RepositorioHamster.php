<?php
require_once '.env.php';
require_once 'Usuario.php';
require_once 'Hamster.php';

class RepositorioHamster
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8'); 
        }
    }

    public function saveHamster(Hamster $u)
    {

        

        $q = "INSERT INTO hamster0 (nombre_hamster, sexo_hamster, fechaNac_hamster) ";
        $q.= "VALUES (?, ?, ?)";
        $query = self::$conexion->prepare($q);
        
        $query->bind_param("sis",$u->getNombre_hamster(), $u->getSexo_hamster(), $u->getFechaNac_hamster() );


        if ( $query->execute() ) {

                    
            // Retornamos el id del usuario recién insertado.
           
                   session_start();
                    $usuario = unserialize($_SESSION['usuario']);
                    $id_usuario = $usuario->getId();

            return $id_usuario;
            return self::$conexion->insert_id;


        }
        else {
            return false;

        }


    }

}
    
