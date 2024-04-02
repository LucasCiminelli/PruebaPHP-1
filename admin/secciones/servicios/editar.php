<?php 
include("../../templates/header.php"); 
include("../../bd.php"); 

// Inicializar las variables
if(isset($_GET["txtid"])){
    $txtId = (isset($_GET["txtid"])) ? $_GET["txtid"] : "";

    $sentencia = $conexion->prepare("SELECT * FROM tbl_servicios WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $icono = $registro["icono"];
    $titulo = $registro["titulo"];
    $descripcion = $registro["descripcion"];
}

if($_POST){
    $txtId = (isset($_POST["txtid"])) ? $_POST["txtid"] : "";
    $icono = (isset($_POST["icono"])) ? $_POST["icono"] : "";
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";

    print_r($_POST);

    $sentencia = $conexion->prepare("UPDATE tbl_servicios SET `icono` = :icono, `titulo` = :titulo, `descripcion` = :descripcion WHERE `id` = :id");

    $sentencia->bindParam(":icono", $icono);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":id", $txtId);

    $mensaje = "Servicio modificado correctamnente";

    if($sentencia->execute()){
        echo "Servicio Modificado correctamente";
        header("location:index.php?mensaje=.$mensaje");
    } else {
        echo "Error al modificar el servicio";
    }
}

?>

<h2 class="text-center mt-5">Editar Servicios</h2>

<div class="card">
    <div class="card-header">Editar Servicios</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="txtid" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtId; ?>" readonly  class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="ID"/>
            </div>

            <div class="mb-3">
                <label for="icono" class="form-label">Icono</label>
                <input type="text" value="<?php echo $icono; ?>" class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono" />
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" value="<?php echo $titulo; ?>" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" value="<?php echo $descripcion; ?>" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción" />
            </div>

            <button type="submit" class="btn btn-success">Editar Servicio</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>
