<?php include("../../templates/header.php"); 


include("../../bd.php"); 

//Recuperar los datos del ID correspondiente (seleccionado)

if(isset($_GET["txtid"])){

    echo $_GET["txtid"];

    $txtId = ( isset($_GET["txtid"]) ) ? $_GET["txtid"] : "";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_portafolio` WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia ->execute();
    $registro = $sentencia ->fetch(PDO::FETCH_LAZY);


    $titulo =$registro["titulo"];    
    $subtitulo =$registro["subtitulo"];    
    $imagen =$registro["imagen"];    
    $descripcion =$registro["descripcion"];    
    $cliente =$registro["cliente"];
    $categoria =$registro["categoria"];
    $url =$registro["url"];
    


}

    if($_POST){
        $txtId = (isset($_POST["txtid"])) ? $_POST["txtid"] : "";
        $titulo = ( isset($_POST["titulo"]) ) ? $_POST["titulo"] : "";
        $subtitulo =( isset($_POST["subtitulo"]) ) ? $_POST["subtitulo"] : "";
        
        // $imagen =( isset($_FILES["imagen"]["name"]) ) ? $_FILES["imagen"]["name"] : "";

        $descripcion =(isset($_POST["descripcion"]) ) ? $_POST["descripcion"] : "";
        $cliente =( isset($_POST["cliente"]) ) ? $_POST["cliente"] : "";
        $categoria =( isset($_POST["categoria"]) ) ? $_POST["categoria"] : "";
        $url =( isset($_POST["url"]) ) ? $_POST["url"] : "";

        print_r($_POST);

        $sentencia = $conexion->prepare(" UPDATE `tbl_portafolio` 
        SET 
        titulo=:titulo, 
        subtitulo=:subtitulo, 
        descripcion=:descripcion, 
        cliente=:cliente, 
        categoria=:categoria, 
        url=:url 
        WHERE id=:id");


        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":subtitulo", $subtitulo);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":cliente", $cliente);
        $sentencia->bindParam(":categoria", $categoria);
        $sentencia->bindParam(":url", $url);
        $sentencia->bindParam(":id", $txtId);

        $mensaje="Portafolio modificado con exito.";

        
        if($sentencia->execute()){
            echo "Portafolio Modificado correctamente";
            header("location:index.php?mensaje=.$mensaje");
        } else{
            echo "Error al modificar el servicio";
        }

        if($_FILES["imagen"]["name"]!= ""){
            $imagen =( isset($_FILES["imagen"]["name"]) ) ? $_FILES["imagen"]["name"] : "";

            $fecha_imagen = new DateTime();
            $nombre_archivo_imagen = ($imagen != "")? $fecha_imagen->getTimestamp()."_".$imagen : "";
    
            $tmp_imagen = $_FILES["imagen"]["tmp_name"];
    
            
            move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombre_archivo_imagen);

            //borrado de archivo anterior en assets/portfolio
            $sentencia = $conexion->prepare("SELECT imagen FROM tbl_portafolio WHERE id=:id");
            $sentencia->bindParam(":id", $txtId);
            $sentencia ->execute();

            $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

            if(isset($registro_imagen["imagen"])){

                if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
                unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
                }
            }
            

            $sentencia = $conexion->prepare(" UPDATE `tbl_portafolio` SET imagen=:imagen WHERE id=:id");
            
            $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
            $sentencia->bindParam(":id", $txtId);
            $sentencia->execute();
        }
       
    }

?>

<h2 class="text-center mt-5">Editar Portfolio</h2>

<div class="card">
    <div class="card-header">Editar la información de Portfolio</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
                <label for="txtid" class="form-label">id</label>
                <input type="text" value="<?php echo $txtId ?>" readonly class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" value="<?php echo $titulo ?>" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título" />
            </div>
            <div class="mb-3">
                <label for="subtitulo" class="form-label">Subtítulo</label>
                <input type="text" value="<?php echo $subtitulo ?>" class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Subtítulo" />
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imágen: </label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen;  ?>" alt="">
                <input type="file" value="<?php echo $imagen ?>" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imágen" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" value="<?php echo $descripcion ?>" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción" />
            </div>
            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" value="<?php echo $cliente ?>" class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Cliente" />
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" value="<?php echo $categoria ?>" class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="Categoría" />
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Url</label>
                <input type="text" value="<?php echo $url ?>" class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="Url del proyecto" />
            </div>
            

            <button type="submit" class="btn btn-success">Editar Portfolio</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>



<?php include("../../templates/footer.php"); ?>