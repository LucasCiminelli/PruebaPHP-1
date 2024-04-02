<?php include("../../templates/header.php"); 


include("../../bd.php"); 


if(isset($_GET["txtid"])){

    echo $_GET["txtid"];

    $txtId = ( isset($_GET["txtid"]) ) ? $_GET["txtid"] : "";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_entradas` WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia ->execute();
    $registro = $sentencia ->fetch(PDO::FETCH_LAZY);

    $fecha = $registro["fecha"];
    $titulo =$registro["titulo"];
    $descripcion =$registro["descripcion"];     
    $imagen =$registro["imagen"];    
}


if ($_POST){

    $txtId = (isset($_POST["txtid"])) ? $_POST["txtid"] : "";
    $fecha = (isset($_POST["fecha"])) ? $_POST["fecha"] : "";
    $titulo = ( isset($_POST["titulo"]) ) ? $_POST["titulo"] : "";
    $descripcion =(isset($_POST["descripcion"]) ) ? $_POST["descripcion"] : "";

    $sentencia = $conexion ->prepare("UPDATE `tbl_entradas` SET fecha=:fecha, titulo=:titulo, descripcion=:descripcion WHERE id=:id");

    $sentencia->bindParam(":id", $txtId);
    $sentencia->bindParam(":fecha", $fecha);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);

    $mensaje="Entrada modificada con exito.";

        
        if($sentencia->execute()){
            echo "Entrada Modificada correctamente";
            header("location:index.php?mensaje=.$mensaje");
        } else{
            echo "Error al modificar el servicio";
        }


    if($_FILES["imagen"]["name"] != ""){
        $imagen =( isset($_FILES["imagen"]["name"]) ) ? $_FILES["imagen"]["name"] : "";

        $fecha_imagen = new DateTime();

        $nombre_archivo_imagen = ($imagen != "")? $fecha_imagen->getTimestamp()."_".$imagen : "";
    
        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
    
            
        move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombre_archivo_imagen);

        $sentencia = $conexion->prepare("SELECT imagen FROM tbl_portafolio WHERE id=:id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia ->execute();

        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registro_imagen["imagen"])){

            if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
                unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
            }
        }
            

        $sentencia = $conexion->prepare(" UPDATE `tbl_entradas` SET imagen=:imagen WHERE id=:id");
            
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();


    }


}










?>

<h2 class="text-center mt-5">Editar Entrada</h2>


<div class="card">
    <div class="card-header">Editar la información de Entradas</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
                <label for="txtid" class="form-label">id</label>
                <input type="text" value="<?php echo $txtId ?>" readonly class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="text" value="<?php echo $fecha ?>" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" />
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" value="<?php echo $titulo ?>" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" value="<?php echo $descripcion ?>" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción" />
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imágen: </label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen;  ?>" alt="">
                <input type="file" value="<?php echo $imagen ?>" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imágen" />
            </div>
            
            

            <button type="submit" class="btn btn-success">Editar Entrada</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
</div>


<?php include("../../templates/footer.php"); ?>