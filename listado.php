
<?php
require_once 'clases/Usuario.php';
require_once 'clases/Hamster.php';
require_once 'clases/RepositorioHamster.php';



session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
	$nomApe = $usuario -> getNombreApellido();
    $rc = new RepositorioHamster();
    $hamster = $rc->get_all($usuario);

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
      </div>    
      <div class="text-center">
        <?php
        if (isset($_GET['mensaje'])) {
            echo '<p class="alert alert-primary">'.$_GET['mensaje'].'</p>';
        }
        ?>
        <h3><?php echo $nomApe;?></h3>
        <h3>Listado de cuentas</h3>
        <table class="table table-striped">
            <tr>
                <th>Nombre</th><th>Sexo</th><th>Edad en Meses</th><th colspan="3">Modificaciones</th>
            </tr>
        <?php
        if (count($hamster) == 0) {
            echo "<tr><td colspan='5'>No tiene cuentas creadas</td></tr>";
        } else {
            foreach ($hamster as $unHamster) {
                $n = $unHamster->getId_hamster();

                $sex = $unHamster->getSexo_hamster();
                if ( $sex == "0") { $sex = "Hembra";  } else { $sex = "Macho";  }
                $fecha = $unHamster->getFechaNac_hamster();
                $yhamster = date("y", strtotime($fecha)); 
                $mhamster = date("m", strtotime($fecha)); 
                $yactual = date("y");
                $mactual = date("m");
                $difm = (($yactual - $yhamster - 1)*12) + (12 - $mhamster) + $mactual;



                echo '<tr>';
                echo "<td id='Nombre-$n'>".$unHamster->getNombre_hamster()."</td>";
                echo "<td id='Sexo-$n'>".$sex."</td>";
                echo "<td id='Edad (Meses)-$n'>".$difm."</td>";
                echo "<td><button type='button' onclick='depositar($n)'>Cambiar Nombre</button></td>";
                echo "<td><button type='button' onclick='depositar($n)'>Cambiar Sexo</button></td>";
                echo "<td><a href='eliminar.php?n=$n'>Eliminar</a></td>";
                echo '</tr>';
            }
        }
        ?>
        </table>
        <br>
        <div id="operacion">
            <h3 id="tipo_operacion">Nuevo Nombre</h3>
            <input type="hidden" id="tipo">
            <input type="hidden" id="numero">
            <label for="monto">Monto de la operación: </label>
            <input type="number" id="monto"><br>
            <button type="button" onclick="operacion();">Realizar operacion</button>
        </div>

      </div> 


      <script>
        function operacion() {
            var tipo = document.querySelector('#tipo').value;
            var cuenta = document.querySelector('#numero').value;
            var monto = document.querySelector('#monto').value;
            var cadena = "tipo="+tipo+"&cuenta="+cuenta+"&monto="+monto;

            var solicitud = new XMLHttpRequest();

            solicitud.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var respuesta = JSON.parse(this.responseText);
                    var identificador = "#saldo-" + respuesta.numero_cuenta;
                    var celda = document.querySelector(identificador);

                    if(respuesta.resultado == "OK") {
                        celda.innerHTML = respuesta.saldo;
                    } else {
                        alert(respuesta.resultado);
                    }
                    celda.scrollIntoView();
                }
            };
            solicitud.open("POST", "operacion.php", true);
            solicitud.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            solicitud.send(cadena);
        }


        function extraer(nroCuenta)
        {
            document.querySelector('#tipo').value = "e";
            document.querySelector('#tipo_operacion').innerHTML = "Extracción";
            document.querySelector('#numero').value = nroCuenta;
            document.querySelector('#monto').focus();
        }

        function depositar(nroCuenta)
        {
            document.querySelector('#tipo').value = "d";
            document.querySelector('#tipo_operacion').innerHTML = "Depósitos/88";
            document.querySelector('#numero').value = nroCuenta;
            document.querySelector('#monto').focus();
        }
</script>

<//////
HACER UNA TABLA CON TODO EL LISTADO DE Hamsters SEGUN CADA USUARIO.


CON NOMBRE, SEXO, Y EDAD ( CALCULAR EDAD DEL HAMSTER SEGUN LOS MESES.)

BUSCAR DE QUE MANERA SE PUEDEN CALCULAR LOS MESES DEL AÑO .

buscar calcular meses de edad.


EN UN COSTADO PONER  DOS BOTONES  "BORRAR"  Y  "ACTUALIZAR".

EL BOTON  BORRAR TE VA A LLEVAR A  
echo "<a href=eliminar.php?id=" . $id_hamster . ">Eliminar</a>":

En el archivo eliminar.php, se accede al id del hamster con $_GET['id']

el delete form *  where id=   TIENE QUE ESTAR EN EL REPOSITORIO SI Ó SI

ELIMINAR.PHP SIEMPRE LLAMA AL REPOSITORIO PARA GUARDAR Y ELIMINAR LOS DATOS-.


WHILE ID > 0 ECHO "TODO LO QUE HAYA EN EL BUCLE"

EL BOTON ACTUALIZAR TE LLEVA A 

////>
