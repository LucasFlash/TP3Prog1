<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioHamster.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/Hamster.php';
session_start();
if (isset($_SESSION['usuario']) && isset($_GET['n'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $rc = new RepositorioHamster();
    $hamster = $rc->get_one($_GET['n']);
    if ($hamster->getId_usuario() != $usuario->getId()) {
        die("Error: La cuenta no pertenece al usuario");
    }
    
     else {
        if ($rc->delete($hamster)) {
            $mensaje = "Hamster eliminado con éxito";
        } else {
            $mensaje = "Error al eliminar el hamster";
        }
        header("Location: home.php?mensaje=$mensaje");
    }
} else {
    header('Location: index.php');
}
?>