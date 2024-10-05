<?php
include 'conexion.inc.php';

$ci = $_GET['ci'];
$codigoCatastral = $_GET['codigoCatastral'];

$sql = "SELECT p.ci, p.nombre, p.paterno, p.materno, c.codigoCatastral, c.zona, c.superficie, c.distrito, 
               c.xini, c.yini, c.xfin, c.yfin, p.idUsuario, u.usuario
        FROM persona p
        JOIN catastro c ON p.ci = c.ci
        JOIN usuario u ON p.idUsuario = u.idUsuario
        WHERE p.ci = ? AND c.codigoCatastral = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $ci, $codigoCatastral);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("No se encontraron datos para el CI y código catastral especificados.");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Editar Persona y Catastro</title>
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
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container-sm py-3">
    <h2>Editar Persona y Catastro</h2>
    <form action="guardar_edicion.php" method="post">
        <input type="hidden" name="ciOriginal" value="<?php echo $ci; ?>">
        <input type="hidden" name="codigoCatastralOriginal" value="<?php echo $codigoCatastral; ?>">

        <!-- Datos de la persona -->
        <div class="form-group">
            <label for="ci">CI:</label>
            <input type="text" class="form-control" id="ci" name="ci" value="<?php echo $data['ci']; ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>" required>
        </div>

        <div class="form-group">
            <label for="paterno">Apellido Paterno:</label>
            <input type="text" class="form-control" id="paterno" name="paterno" value="<?php echo $data['paterno']; ?>" required>
        </div>

        <div class="form-group">
            <label for="materno">Apellido Materno:</label>
            <input type="text" class="form-control" id="materno" name="materno" value="<?php echo $data['materno']; ?>" required>
        </div>

        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $data['usuario']; ?>" required>
        </div>

        <div class="form-group">
            <label for="contrasena">Nueva Contraseña:</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena">
            <small class="form-text text-muted">Deja vacío si no deseas cambiar la contraseña.</small>
        </div>

        <!-- Datos del catastro -->
        <div class="form-group">
            <label for="codigoCatastral">Código Catastral:</label>
            <input type="text" class="form-control" id="codigoCatastral" name="codigoCatastral" value="<?php echo $data['codigoCatastral']; ?>" required>
        </div>

        <div class="form-group">
            <label for="zona">Zona:</label>
            <input type="text" class="form-control" id="zona" name="zona" value="<?php echo $data['zona']; ?>" required>
        </div>

        <div class="form-group">
            <label for="superficie">Superficie:</label>
            <input type="text" class="form-control" id="superficie" name="superficie" value="<?php echo $data['superficie']; ?>" required>
        </div>

        <div class="form-group">
            <label for="distrito">Distrito:</label>
            <input type="text" class="form-control" id="distrito" name="distrito" value="<?php echo $data['distrito']; ?>" required>
        </div>

        <!-- Coordenadas -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="xini">Coordenada X inicial:</label>
                    <input type="number" step="0.01" name="xini" id="xini" class="form-control" value="<?php echo $data['xini']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="xfin">Coordenada X final:</label>
                    <input type="number" step="0.01" name="xfin" id="xfin" class="form-control" value="<?php echo $data['xfin']; ?>" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="yini">Coordenada Y inicial:</label>
                    <input type="number" step="0.01" name="yini" id="yini" class="form-control" value="<?php echo $data['yini']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="yfin">Coordenada Y final:</label>
                    <input type="number" step="0.01" name="yfin" id="yfin" class="form-control" value="<?php echo $data['yfin']; ?>" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
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
                Sopocachi: ['Sopocachi', 'San Miguel'],
                Max_Paredes: ['Max Paredes', 'Villa Fatima'],
                Centro: ['16 de Julio', 'Eloy Salmón', 'San Pedro']
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


