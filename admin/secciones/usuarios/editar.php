<?php include("../../templates/header.php"); 

include("../../bd.php");

//Obtener datos

if(isset($_GET["txtid"])){
    $txtId = (isset($_GET["txtid"])) ?  $_GET["txtid"] : "";

    $sentencia = $conexion -> prepare("SELECT * FROM `tbl_usuarios` WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia ->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];
}

//Modificar datos

if($_POST){
    $txtId = (isset($_POST["txtid"])) ? $_POST["txtid"] : "";
    $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
    $password = (isset($_POST["password"])) ? $_POST["password"] : "";
    $correo = (isset($_POST["correo"])) ? $_POST["correo"] : "";

    print_r($_POST);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET `usuario` = :usuario, `password` = :password, `correo` = :correo WHERE `id` = :id");

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $hashed_password);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":id", $txtId);

    $mensaje = "Usuario modificado correctamnente";

    if($sentencia->execute()){
        echo "Usuario Modificado correctamente";
        header("location:index.php?mensaje=.$mensaje");
    } else {
        echo "Error al modificar el servicio";
    }
}





?>

<h2 class="text-center mt-5">Editar Usuarios</h2>


<div class="card">
    <div class="card-header">Usuario</div>
    <div class="card-body">
        <form action="" method="post">
        <div class="mb-3">
                <label for="txtid" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtId; ?>" readonly  class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="ID"/>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del Usuario</label>
                <input type="text" value="<?php echo $usuario; ?>"  class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del Usuario"/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" value="<?php echo $password; ?>" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password"/>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" value="<?php echo $correo; ?>" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo"/>
            </div>

            <button type="submit" class="btn btn-success">Editar Usuario</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    
</div>


<?php include("../../templates/footer.php"); ?>