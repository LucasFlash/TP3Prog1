<?php
require_once 'clases/Usuario.php';//LE PEDIMOS ESOS DATOS DE USUARIO PARA MOSTRAR EN UN MENSAJE DE BIENVENIDA//
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Sistema bancario</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema bancario</h1>
	          <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
      
        ?>

      </div>    
      <div class="text-center">
        <h3>Hola <?php echo $nomApe;?></h3>
        <h6>
        <a href="listado.php">Listado de Hamsters</a><br>
        <a href="createHamster.php">Añadir</a><br>
        <a href="borrar.php">Actualizar</a><br>
        <a href="calcularEdad.php">Borrar</a><br>
        <p><a href="logout.php">Cerrar sesión</a></p>
      </div> 
    </body>
</html>

