<?php
include 'conexion.inc.php';

$sql = "
    SELECT 
        CASE WHEN SUBSTRING(c.codigoCatastral, 1, 1) = '1' THEN CONCAT(p.nombre, ' (', p.ci, ')') END AS `ImpuestoAlto`,
        CASE WHEN SUBSTRING(c.codigoCatastral, 1, 1) = '2' THEN CONCAT(p.nombre, ' (', p.ci, ')') END AS `ImpuestoMedio`,
        CASE WHEN SUBSTRING(c.codigoCatastral, 1, 1) = '3' THEN CONCAT(p.nombre, ' (', p.ci, ')') END AS `ImpuestoBajo`
    FROM 
        persona p
    JOIN 
        catastro c ON p.ci = c.ci
    WHERE 
        SUBSTRING(c.codigoCatastral, 1, 1) IN ('1', '2', '3')
    ORDER BY 
        p.nombre
";

$result = $con->query($sql);

$personasImpuestoAlto = [];
$personasImpuestoMedio = [];
$personasImpuestoBajo = [];

while ($row = $result->fetch_assoc()) {
    if (!empty($row['ImpuestoAlto'])) {
        $personasImpuestoAlto[] = $row['ImpuestoAlto'];
    }
    if (!empty($row['ImpuestoMedio'])) {
        $personasImpuestoMedio[] = $row['ImpuestoMedio'];
    }
    if (!empty($row['ImpuestoBajo'])) {
        $personasImpuestoBajo[] = $row['ImpuestoBajo'];
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>ver propiedades</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="crud2.css">
    <style>
    .table th, .table td {
        width: 33%; /* Ajusta el ancho de cada columna */
        text-align: center; /* Centrar el texto en las columnas */
    }
</style>
</head>

<body>
    

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"> <img class="img-fluid" src="img/logo2.png" alt="" style="width: 85px; height: 85px;">
                HAM-LP</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="crud.php" class="nav-item nav-link active">Inicio</a>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Trámites y servicios</a>
                    <div class="dropdown-menu m-0">
                        <a href="" class="dropdown-item">Impuestos Municipales</a>
                        <a href="" class="dropdown-item">Catastro y territorio</a>
                        <a href="" class="dropdown-item">Negocios y comercio</a>
                    </div>
                </div>
                <a href="" class="nav-item nav-link">Listado Personas por Impuesto</a> 
            </div>
          
    </nav>
    <!-- Navbar End -->

    
    <!-- Service End -->
	<div class="container-xxl py-5">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6 ">
						<h2 style="color: white;">   Listado de Persona por Impuestos</h2>
					</div>
				
				</div>
			</div>
			<table class="table table-striped ">
				<thead>
					<tr>
                        <th>Impuesto Alto</th>
                        <th>Impuesto Medio</th>
                        <th>Impuesto Bajo</th>
					</tr>
				</thead>
                <tbody>
                <?php
                $maxRows = max(count($personasImpuestoAlto), count($personasImpuestoMedio), count($personasImpuestoBajo));

                for ($i = 0; $i < $maxRows; $i++) {
                    echo '<tr>';
                    echo '<td>' . (!empty($personasImpuestoAlto[$i]) ? $personasImpuestoAlto[$i] : '') . '</td>';
                    echo '<td>' . (!empty($personasImpuestoMedio[$i]) ? $personasImpuestoMedio[$i] : '') . '</td>';
                    echo '<td>' . (!empty($personasImpuestoBajo[$i]) ? $personasImpuestoBajo[$i] : '') . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
			</table>
			
		</div>
	</div>        
</div>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">2024 Honorable Alcaldía Municipal de La Paz. </a>, Todos los derechos reservados.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>


