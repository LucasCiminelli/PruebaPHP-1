
<?php

if(isset($_GET["txtid"])){



    $txtId = ( isset($_GET["txtid"]) ) ? $_GET["txtid"] : "";

    $sentencia = $conexion->prepare("DELETE FROM tbl_servicios WHERE id=:id");


    $sentencia->bindParam(":id", $txtId);

    $sentencia ->execute();


}


?>
