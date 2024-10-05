<?php 
include("conexion.inc.php");
session_start();

if(!empty($_POST)){
    $usuario = trim($_POST['usuario']); 
    $password = trim($_POST['contrasenia']);  
    login($usuario, $password, $con); 
}

function login($usuario, $password, $con){
    $sql = "SELECT *, COUNT(*) as cantidad FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($con, $sql);
    $fila = mysqli_fetch_array($resultado);
    if($fila["cantidad"] > 0){
        if($password == $fila['contrasenia']){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $fila['rol'];
            $_SESSION['idUsuario'] = $fila['idUsuario'];

            if($fila['rol'] == 'admin'){
                header("Location: crud.php");
            } else if($fila['rol'] == 'usuario'){
                header("Location: inicio_usuario.php"); 
            } else if($fila['rol'] == 'funcionario'){
                header("Location: crud.php");
            }
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "El usuario no existe";
    }
}
?>



<!Doctype html>
<html lang="es">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	

	<link rel="stylesheet" href="style.css">

	
	<style>
		body{
			background: #06BBCC;
		}
	</style>

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Iniciar Sesión</h3>
						<form action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post" class="login-form">
		      		<div class="form-group">
		      			<input type="text" name= "usuario" class="form-control rounded-left" placeholder="Usuario" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" name= "contrasenia" class="form-control rounded-left" placeholder="Contraseña" required>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Acceder</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
	            		<label class="checkbox-wrap checkbox-primary">Recordarme
							<input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
							</div>
						<div class="w-50 text-md-right">
					<a href="#">¿Has olvidado tu contraseña?</a>
					</div>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>


	</body>
</html>

