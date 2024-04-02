<?php 


session_start();

if($_POST){
    include("./bd.php");

    $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
    $password =(isset($_POST["password"])) ? $_POST["password"] : "";

    $sentencia = $conexion->prepare("SELECT *, count(*) as n_usuario FROM `tbl_usuarios` WHERE usuario=:usuario");

    $sentencia->bindParam(":usuario", $usuario);

    $sentencia -> execute();

    $usuario_encontrado = $sentencia -> fetch(PDO::FETCH_LAZY);

    $mensaje = "";

    if($usuario_encontrado["n_usuario"] > 0){

        if(password_verify($password, $usuario_encontrado["password"])){
            print_r("El usuario y la contraseña existe");
            $_SESSION["usuario"]=$usuario_encontrado["usuario"];
            $_SESSION["logueado"] = true;
            header("location:index.php");
        } else {
            $mensaje= "Contraseña incorrecta";
        }

        
    } else{
        $mensaje = "El usuario o la contraseña NO existe";
    }

}




?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
        <h1 class="text-center mt-5">Login</h1>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-container d-flex flex-column justify-content-center">
                        <?php if(isset($mensaje)) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong><?php echo $mensaje; ?></strong>
                        </div>  
                        <?php } ?>
                        <script>
                            var alertList = document.querySelectorAll(".alert");
                            alertList.forEach(function (alert) {
                                new bootstrap.Alert(alert);
                            });
                        </script>
                       
                        <div class="card">
                            <div class="card-header">Login</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="usuario" class="form-label">Usuario</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="usuario"
                                            id="usuario"
                                            aria-describedby="helpId"
                                            placeholder="ingresá tu usuario"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            id="password"
                                            aria-describedby="helpId"
                                            placeholder="Ingresá tu password"
                                        />
                                    </div>
                                    <input name="" id="" class="btn btn-success w-100" type="submit" value="Login"/>
                                    
                                    
                                </form>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="col-md-4"></div>
                
            </div>
        </div>
        

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
