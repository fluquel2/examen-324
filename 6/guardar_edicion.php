<?php
include 'conexion.inc.php';

$ciOriginal = $_POST['ciOriginal'];
$codigoCatastralOriginal = $_POST['codigoCatastralOriginal'];

$ci = $_POST['ci'];
$nombre = $_POST['nombre'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena']; 

$codigoCatastral = $_POST['codigoCatastral'];
$zona = $_POST['zona'];
$superficie = $_POST['superficie'];
$distrito = $_POST['distrito'];
$xini = $_POST['xini'];
$yini = $_POST['yini'];
$xfin = $_POST['xfin'];
$yfin = $_POST['yfin'];


$sqlPersona = "UPDATE persona SET ci=?, nombre=?, paterno=?, materno=? WHERE ci=?";
$stmtPersona = $con->prepare($sqlPersona);
$stmtPersona->bind_param("sssss", $ci, $nombre, $paterno, $materno, $ciOriginal);
$stmtPersona->execute();


$sqlUsuario = "UPDATE usuario u
               JOIN persona p ON u.idUsuario = p.idUsuario
               SET u.usuario=?";
if (!empty($contrasena)) {
    $sqlUsuario .= ", u.contrasenia=?";
}
$sqlUsuario .= " WHERE p.ci=?";
$stmtUsuario = $con->prepare($sqlUsuario);

if (!empty($contrasena)) {
    $stmtUsuario->bind_param("sss", $usuario, $contrasena, $ciOriginal);
} else {
    $stmtUsuario->bind_param("ss", $usuario, $ciOriginal);
}

$stmtUsuario->execute();

// Actualización de la tabla catastro
$sqlCatastro = "UPDATE catastro SET codigoCatastral=?, zona=?, superficie=?, distrito=?, xini=?, yini=?, xfin=?, yfin=? WHERE codigoCatastral=?";
$stmtCatastro = $con->prepare($sqlCatastro);
$stmtCatastro->bind_param("ssdsddddd", $codigoCatastral, $zona, $superficie, $distrito, $xini, $yini, $xfin, $yfin, $codigoCatastralOriginal);
$stmtCatastro->execute();

// Redireccionar o mostrar mensaje de éxito
header("Location: crud.php");
exit;
?>
