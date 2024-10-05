<?php
include 'conexion.inc.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.inc.php';

    $ci = $_POST['ci'];
    $superficie = $_POST['superficie'];
    $distrito = $_POST['distrito'];
    $zona = $_POST['zona'];
    $xini = $_POST['xini'];
    $xfin = $_POST['xfin'];
    $yini = $_POST['yini'];
    $yfin = $_POST['yfin'];

    $sql = "INSERT INTO Catastro (codigoCatastral, superficie, distrito, zona, xini, xfin, yini, yfin, ci) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $primerDigito = rand(1, 3);
    $codigoCatastral = $primerDigito . rand(1000, 9999); 

    $stmt = $con->prepare($sql);
    $stmt->bind_param("sdssddddd", $codigoCatastral, $superficie, $distrito, $zona, $xini, $xfin, $yini, $yfin, $ci);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

        header("Location: crud.php");
    } else {

        header("Location: crud.php?mensaje=Error al registrar el catastro");
    }
}

?>
