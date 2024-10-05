<?php
include 'conexion.inc.php';


$ci = $_POST['ci'];
$nombre = $_POST['nombre'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$superficie = $_POST['superficie'];
$distrito = $_POST['distrito'];
$zona = $_POST['zona'];
$xini = $_POST['xini'];
$xfin = $_POST['xfin'];
$yini = $_POST['yini'];
$yfin = $_POST['yfin'];

$primerDigito = rand(1, 3);
$codigoCatastral = $primerDigito . rand(1000, 9999); 

$sqlUsuario = "INSERT INTO usuario (usuario, contrasenia, rol) VALUES ('$nombre', '$ci', 'usuario')";
if (mysqli_query($con, $sqlUsuario)) {
  
    $idUsuario = mysqli_insert_id($con);

  
    $sqlPersona = "INSERT INTO persona (ci, nombre, paterno, materno, idUsuario) VALUES ('$ci', '$nombre', '$paterno', '$materno', '$idUsuario')";
    if (mysqli_query($con, $sqlPersona)) {
        

        $sqlCatastro = "INSERT INTO Catastro (codigoCatastral, zona, superficie, distrito, ci, xini, yini, xfin, yfin) 
                        VALUES ('$codigoCatastral', '$zona', '$superficie', '$distrito', '$ci', '$xini', '$yini', '$xfin', '$yfin')";
        if (mysqli_query($con, $sqlCatastro)) {
            echo "Registro exitoso de persona y catastro";
        } else {
            echo "Error al registrar el catastro: " . mysqli_error($con);
        }
    } else {
        echo "Error al registrar la persona: " . mysqli_error($con);
    }
} else {
    echo "Error al registrar el usuario: " . mysqli_error($con);
}


mysqli_close($con);
?>
