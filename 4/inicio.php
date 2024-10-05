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
            <a href="login.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Acceso<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="position-relative">
            <!-- Imagen con texto superpuesto -->
            <img class="img-fluid w-100 h-100" src="img/contaminacion2.png" alt="Imagen de Contaminación">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-sm-10 col-lg-8">
                            <h1 class="display-3 text-white">Información General de la HAM-LP</h1>
                            <p class="fs-5 text-white mb-4 pb-2">
                                La Honorable Alcaldía Municipal de La Paz (HAM-LP) tiene como misión velar por el bienestar de los ciudadanos, mejorar la infraestructura urbana, y proporcionar servicios públicos de calidad. Su visión es consolidar a La Paz como una ciudad moderna, eficiente, y respetuosa del medio ambiente.
                                La HAM-LP gestiona una variedad de áreas, como educación, salud, infraestructura, seguridad ciudadana y desarrollo urbano, con un enfoque en la transparencia y el servicio público eficiente.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justify-content-center"> <!-- Añadido justify-content-center -->
                <div class="col-lg-3 col-sm-6">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-file-invoice-dollar text-primary mb-4"></i>

                            <h5 class="mb-3">Impuestos Municipales</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <i class="fa fa-3x fa-map text-primary mb-4"></i>

                            <h5 class="mb-3">Catastro y territorio</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <i class="fa fa-3x fa-briefcase text-primary mb-4"></i>

                            <h5 class="mb-3">Negocios y comercio</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Service End -->

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
