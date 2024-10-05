<?php
include 'conexion.inc.php';

$ci = $_GET['ci'];
$codigoCatastral = $_GET['codigoCatastral'];

$sqlDeleteCatastro = "DELETE FROM Catastro WHERE codigoCatastral = ?";
$stmtCatastro = $con->prepare($sqlDeleteCatastro);
$stmtCatastro->bind_param("s", $codigoCatastral);
$stmtCatastro->execute();


$sqlCheckCatastros = "SELECT COUNT(*) as total FROM Catastro WHERE ci = ?";
$stmtCheck = $con->prepare($sqlCheckCatastros);
$stmtCheck->bind_param("s", $ci);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();
$dataCheck = $resultCheck->fetch_assoc();

if ($dataCheck['total'] == 0) {
    $sqlGetIdUsuario = "SELECT idUsuario FROM persona WHERE ci = ?";
    $stmtIdUsuario = $con->prepare($sqlGetIdUsuario);
    $stmtIdUsuario->bind_param("s", $ci);
    $stmtIdUsuario->execute();
    $resultIdUsuario = $stmtIdUsuario->get_result();
    $dataIdUsuario = $resultIdUsuario->fetch_assoc();

    $sqlDeletePersona = "DELETE FROM persona WHERE ci = ?";
    $stmtPersona = $con->prepare($sqlDeletePersona);
    $stmtPersona->bind_param("s", $ci);
    $stmtPersona->execute();

    if ($dataIdUsuario) {
        $sqlDeleteUsuario = "DELETE FROM usuario WHERE idUsuario = ?";
        $stmtUsuario = $con->prepare($sqlDeleteUsuario);
        $stmtUsuario->bind_param("i", $dataIdUsuario['idUsuario']); 
        $stmtUsuario->execute();
    }
}


header("Location: crud.php");
exit();
?>


