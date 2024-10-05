<?php
include 'conexion.inc.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>HAMLP</title>
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
                <a href="index.html" class="nav-item nav-link active">Inicio</a>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Trámites y servicios</a>
                    <div class="dropdown-menu m-0">
                        <a href="team.html" class="dropdown-item">Impuestos Municipales</a>
                        <a href="testimonial.html" class="dropdown-item">Catastro y territorio</a>
                        <a href="404.html" class="dropdown-item">Negocios y comercio</a>
                    </div>
                </div>
                <!-- <a href="contact.html" class="nav-item nav-link">Contact</a> -->
            </div>
          
    </nav>
    <!-- Navbar End -->

    
    <!-- Service End -->
	<div class="container-sm py-3">
    <h2>Registro de Catastro</h2>
    <h5>Registrar y asociar un catastro a una persona ya registrada.</h5>

    <form action="registrar_catastro.php" method="POST" >
        <div class="form-group">
            <label for="ci">CI de la Persona:</label>
            <select name="ci" id="ci" class="form-control" required>
                <option value="">Selecciona un CI</option>
                <?php
                include 'conexion.inc.php'; // Incluye tu conexión a la base de datos

                // Consulta para obtener los CI de las personas registradas
                $sql = "SELECT ci, nombre, paterno, materno FROM persona";
                $result = $con->query($sql);

                // Llenar el menú desplegable con los resultados
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['ci'] . "'>" . $row['ci'] . " - " . $row['nombre'] . " " . $row['paterno'] . " " . $row['materno'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="superficie">Superficie (m²):</label>
            <input type="number" step="0.01" name="superficie" id="superficie" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="distrito">Distrito:</label>
            <select id="distrito" name="distrito" class="form-control" required>
                <option value="">Selecciona un Distrito</option>
                <option value="Sopocachi">Sopocachi</option>
                <option value="Max_Paredes">Max Paredes</option>
                <option value="Centro">Centro</option>
                <option value="Miraflores">Miraflores</option>
                <option value="Sur">Sur</option>
                <option value="Periférica">Periférica</option>
                <option value="Cotahuma">Cotahuma</option>
                <option value="San_Antonio">San Antonio</option>
            </select>
            <label for="zona">Zona:</label>
            <select id="zona" name="zona" class="form-control" required>
                <option value="">Selecciona una Zona</option>
            </select>

        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="xini">Coordenada X inicial:</label>
                    <input type="number" step="0.01" name="xini" id="xini" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="xfin">Coordenada X final:</label>
                    <input type="number" step="0.01" name="xfin" id="xfin" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="yini">Coordenada Y inicial:</label>
                    <input type="number" step="0.01" name="yini" id="yini" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="yfin">Coordenada Y final:</label>
                    <input type="number" step="0.01" name="yfin" id="yfin" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary btn-sm mt-3 me-2">Registrar</button>
                    <a href="crud.php" class="btn btn-danger btn-sm mt-3">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const zonasPorDistrito = {
                Sopocachi: ['Sopocachi', 'San Miguel', 'Sopocachi Bajo', 'Plaza España'],
                Max_Paredes: ['Max Paredes', 'Villa Fátima', 'Gran Poder', 'Villa Victoria'],
                Centro: ['16 de Julio', 'Eloy Salmón', 'San Pedro', 'San Sebastián', 'San Jorge'],
                Miraflores: ['Miraflores Alto', 'Miraflores Bajo', 'Villa Copacabana', 'Villa Armonía'],
                Sur: ['Calacoto', 'Obrajes', 'Achumani', 'Irpavi', 'Cota Cota'],
                Periférica: ['Villa El Carmen', 'Villa Copacabana', 'Kupini', 'Munaypata'],
                Cotahuma: ['Llojeta', 'Villa Pabón', 'Tembladerani', 'Bajo Llojeta'],
                San_Antonio: ['San Antonio', 'Valle Hermoso', 'Valle de las Flores', 'Pamplona']
            };
            
            $('#distrito').change(function() {
                const idDistrito = $(this).val();
                const zonas = zonasPorDistrito[idDistrito] || [];
                $('#zona').empty();
                $('#zona').append('<option value="">Selecciona una Zona</option>');

                zonas.forEach(zona => {
                    $('#zona').append('<option value="' + zona + '">' + zona + '</option>');
                });
            });
        });
        </script>

    
</body>
</html>


