<?php
    $con = mysqli_connect("localhost","root","","BDFernando");
    
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
?>