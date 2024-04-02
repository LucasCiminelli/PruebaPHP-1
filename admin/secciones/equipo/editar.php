<?php include("../../templates/header.php"); 
include("../../bd.php");


if(isset($_GET["txtid"])){


    $txtId = (isset($_GET["txtid"])) ? $_GET["txtid"] : "";

    $sentencia = $conexion ->prepare("SELECT * FROM `tbl_equipo` WHERE id=:id");
    $sentencia ->bindParam(":id", $txtId);
    $sentencia ->execute();
    $registro = $sentencia ->fetch(PDO::FETCH_LAZY);

    $imagen = $registro["imagen"];
    $nombre_completo = $registro["nombrecompleto"];
    $puesto = $registro["puesto"];
    $twitter = $registro["twitter"];
    $facebook = $registro["facebook"];
    $linkedin = $registro["linkedin"];



}

if($_POST){

    $txtId = (isset($_POST["txtid"])) ? $_POST["txtid"] : "";
    $nombre_completo = (isset($_POST["nombre_completo"])) ? $_POST["nombre_completo"] : "";
    $puesto = (isset($_POST["puesto"])) ? $_POST["puesto"] : "";
    $twitter = (isset($_POST["twitter"])) ? $_POST["twitter"] : "";
    $facebook = (isset($_POST["facebook"])) ? $_POST["facebook"] : "";
    $linkedin = (isset($_POST["linkedin"])) ? $_POST["linkedin"] : "";

    $sentencia = $conexion->prepare("UPDATE `tbl_equipo` SET nombrecompleto=:nombre_completo, puesto=:puesto, twitter=:twitter, facebook=:facebook, linkedin=:linkedin WHERE id=:id");

    $sentencia->bindParam(":id", $txtId);
    $sentencia ->bindParam(":nombre_completo", $nombre_completo);
    $sentencia ->bindParam(":puesto", $puesto);
    $sentencia ->bindParam(":twitter", $twitter);
    $sentencia ->bindParam(":facebook", $facebook);
    $sentencia ->bindParam(":linkedin", $linkedin);

    $mensaje="Miembro modificado con exito.";

    if($sentencia->execute()){
        echo "Miembro Modificado correctamente";
        header("location:index.php?mensaje=.$mensaje");
    } else{
        echo "Error al modificar el servicio";
    }

    if($_FILES["imagen"]["name"] != ""){

        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";

        $fecha_imagen = new DateTime();

        $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp()."_".$imagen : "";

        $tmp_imagen = $_FILES["imagen"]["tmp_name"];


        move_uploaded_file($tmp_imagen, "../../../assets/img/team/".$nombre_archivo_imagen);

        $sentencia = $conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id");
        $sentencia ->bindParam(":id", $txtId);
        $sentencia->execute();

        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registro_imagen["imagen"])){
            if(file_exists("../../../assets/img/team/".$registro_imagen["imagen"])){
                unlink("../../../assets/img/team/".$registro_imagen["imagen"]);
            }
        }

        $sentencia = $conexion->prepare("UPDATE `tbl_equipo` SET imagen=:imagen WHERE id=:id");

        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();


    }


}



?>

<h2 class="text-center mt-5 mb-3">Editar Equipo</h2>

<div class="card">
    <div class="card-header">Editar la información del miembro del equipo</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
                <label for="txtid" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtId ?>" readonly class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imágen: </label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen;  ?>" alt="">
                <input type="file" value="<?php echo $imagen ?>" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imágen" />
            </div>
            <div class="mb-3">
                <label for="nombre_completo" class="form-label">Nombre Completo</label>
                <input type="text" value="<?php echo $nombre_completo ?>" class="form-control" name="nombre_completo" id="nombre_completo" aria-describedby="helpId" placeholder="Nombre Completo" />
            </div>
            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto</label>
                <input type="text" value="<?php echo $puesto ?>" class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto" />
            </div>
            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter</label>
                <input type="text" value="<?php echo $twitter ?>" class="form-control" name="twitter" id="twitter" aria-describedby="helpId" placeholder="Twitter" />
            </div>
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="text" value="<?php echo $facebook ?>" class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Facebook" />
            </div>
            <div class="mb-3">
                <label for="linkedin" class="form-label">Linkedin</label>
                <input type="text" value="<?php echo $linkedin ?>" class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Linkedin" />
            </div>
            
            
            

            <button type="submit" class="btn btn-success">Editar Entrada</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
</div>


<?php include("../../templates/footer.php"); ?>