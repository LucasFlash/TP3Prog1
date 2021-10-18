<?php
require_once 'clases/ControladorSesion.php';
if (isset($_POST['nombre_hamster'])) { //SI DA FALSO, VUELVE A MOSTRAR EL FORMULARIO//
    $cs = new ControladorSesion();
    $result = $cs->createHamster($_POST['nombre_hamster'], $_POST['sexo_hamster'], $_POST['fechaNac_hamster']);
    if( $result[0] === true ) {
        $redirigir = 'home.php?mensaje='.$result[1];
    }
    else {
        $redirigir = 'createhamster.php?mensaje='.$result[1];
    }
    header('Location: ' . $redirigir);
}
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Bienvenido al sistema</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema bancario</h1>
      </div>    
      <div class="text-center">
        <h3>Crear nuevo usuario</h3>
        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>

        <form action="createHamster.php" method="post">
        <input name="nombre_hamster"></input><br>
            <select name="sexo_hamster">
            <option value="0">Hembra</option>
            <option value="1">Macho</option>
            </select><br>
            <input type="date" name="fechaNac_hamster"><br>

         <input type="submit" value="Registrarse" class="btn btn-primary">
        </form>        
      </div> 
    </body>
</html>
