<?php include("../../templates/header.php"); 
include("../../bd.php");


if($_POST){
    $fecha = (isset($_POST["fecha"])) ? $_POST["fecha"]: "";
    $titulo = ( isset($_POST["titulo"]) ) ? $_POST["titulo"] : "";
    $descripcion =(isset($_POST["descripcion"]) ) ? $_POST["descripcion"] : "";
    $imagen =( isset($_FILES["imagen"]["name"]) ) ? $_FILES["imagen"]["name"] : "";


    $fecha_imagen = new DateTime();

    $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp()."_".$imagen : "";

    $tmp_imagen = $_FILES["imagen"]["tmp_name"];

    if($tmp_imagen != ""){
    move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/".$nombre_archivo_imagen);
    }


    if($fecha == "" || $titulo == "" || $descripcion == "" || $imagen == ""){
        echo "Error, campos incompletos";
    }else{
        $sentencia = $conexion ->prepare("INSERT INTO `tbl_entradas` (`id`, `fecha`, `titulo`, `descripcion`, `imagen`) VALUES (NULL, :fecha, :titulo, :descripcion, :imagen);");

        $sentencia->bindParam(":fecha", $fecha);
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
    
        $mensaje="Entrada Agregada con exito.";

        
        if($sentencia->execute()){
            echo "Entrada Agregada correctamente";
            header("location:index.php?mensaje=.$mensaje");
        } else{
            echo "Error al modificar la entrada";
        }
    }
}


?>

<h2 class="text-center mt-5">Crear Entrada</h2>


<div class="card">
    <div class="card-header">Crear Entrada</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="text"  class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" />
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text"  class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text"  class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imágen</label>
                <input type="file"  class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imágen" />
            </div>

            <button type="submit" class="btn btn-success">Agregar Portafolio</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>
    </div>
</div>









<?php include("../../templates/footer.php"); ?>