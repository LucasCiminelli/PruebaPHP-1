<?php include("../../templates/header.php"); 
include("../../bd.php");

if($_POST){

    print_r($_FILES);

    $titulo = ( isset($_POST["titulo"]) ) ? $_POST["titulo"] : "";
    $subtitulo =( isset($_POST["subtitulo"]) ) ? $_POST["subtitulo"] : "";
    $imagen =( isset($_FILES["imagen"]["name"]) ) ? $_FILES["imagen"]["name"] : "";
    $descripcion =(isset($_POST["descripcion"]) ) ? $_POST["descripcion"] : "";
    $cliente =( isset($_POST["cliente"]) ) ? $_POST["cliente"] : "";
    $categoria =( isset($_POST["categoria"]) ) ? $_POST["categoria"] : "";
    $url =( isset($_POST["url"]) ) ? $_POST["url"] : "";

    
    $fecha_imagen = new DateTime();
    $nombre_archivo_imagen = ($imagen != "")? $fecha_imagen->getTimestamp()."_".$imagen : "";

    $tmp_imagen = $_FILES["imagen"]["tmp_name"];

    if($tmp_imagen != ""){
        move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombre_archivo_imagen);
    }



    if($titulo == "" || $descripcion == "" || $imagen=="" || $cliente=="" || $categoria=="" || $url==""){
        echo "Error, campos incompletos";
    } else{
        $sentencia = $conexion->prepare("INSERT INTO `tbl_portafolio` (`id`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`) VALUES (NULL, :titulo, :subtitulo, :imagen, :descripcion, :cliente, :categoria, :url);");


        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":subtitulo", $subtitulo);
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":cliente", $cliente);
        $sentencia->bindParam(":categoria", $categoria);
        $sentencia->bindParam(":url", $url);

        
        $mensaje="Servicio Agregado con exito.";

        
        if($sentencia->execute()){
            echo "Portafolio Agregado correctamente";
            header("location:index.php?mensaje=.$mensaje");
        } else{
            echo "Error al modificar el servicio";
        }

    }
    

}



?>

<h2 class="text-center mt-5">Crear Portfolio</h2>




<div class="card">
    <div class="card-header">Crear portafolio</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text"  class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título" />
            </div>
            <div class="mb-3">
                <label for="subtitulo" class="form-label">Subtítulo</label>
                <input type="text"  class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Subtítulo" />
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imágen</label>
                <input type="file"  class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imágen" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text"  class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
            </div>
            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text"  class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Cliente" />
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text"  class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="Categoría" />
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Url</label>
                <input type="text"  class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="Url del proyecto" />
            </div>

            <button type="submit" class="btn btn-success">Agregar Portafolio</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>
    </div>
</div>











<?php include("../../templates/footer.php"); ?>