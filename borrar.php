<hmtl>
	<h2>HOLA</h2>
	<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/ControladorSesion.php';
require_once 'clases/Hamster.php';

        session_start();
      
        $usuario = unserialize($_SESSION['usuario']);
        $id_usuario = $usuario->getId();
        
        echo $id_usuario;
         


echo "la fecha actual es " . date("d") . " del " . date("m") . " de " . date("Y");

        ?>
    </hmtl>