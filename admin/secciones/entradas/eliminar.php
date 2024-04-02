
<?php

if(isset($_GET["txtid"])){

   

    $txtId = ( isset($_GET["txtid"]) ) ? $_GET["txtid"] : "";

    $sentencia = $conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia ->execute();

    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){

        if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
            unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
        } 

    }



     $sentencia = $conexion->prepare("DELETE FROM tbl_entradas WHERE id=:id");
     $sentencia->bindParam(":id", $txtId);
     $sentencia ->execute();


}


?>