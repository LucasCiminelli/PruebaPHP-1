<?php include("../../templates/header.php"); 

include("../../bd.php"); 



if($_POST){
    $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
    $password =(isset($_POST["password"])) ? $_POST["password"] : "";
    $correo =(isset($_POST["correo"])) ? $_POST["correo"] : "";

    if($usuario == "" || $password == "" || $correo == ""){
        echo "Error, campos incompletos";
    } else{

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);


        $sentencia = $conexion ->prepare("INSERT INTO `tbl_usuarios` (`id`, `usuario`, `password`, `correo`) VALUES (NULL, :usuario, :password, :correo);");
        $sentencia ->bindParam(":usuario", $usuario);
        $sentencia ->bindParam(":password", $hashed_password);
        $sentencia ->bindParam(":correo", $correo);

        $mensaje = "Usuario creado con exito";

        if($sentencia -> execute()){
            echo "Usuario creado con éxito";
            header("location:index.php?mensaje=$mensaje");
        } else{
            echo "Error al crear el usuario";
        }

    }


}





?>

<h2 class="text-center mt-5">Crear Usuario</h2>


<div class="card">
    <div class="card-header">Usuario</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del Usuario"/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password"/>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo"/>
            </div>

            <button type="submit" class="btn btn-success">Agregar Usuario</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    
</div>







<?php include("../../templates/footer.php"); ?>