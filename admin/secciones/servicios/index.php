<?php include("../../templates/header.php"); 

include("../../bd.php");

include("../servicios/eliminar.php");


$sentencia = $conexion -> prepare("SELECT * FROM `tbl_servicios`");

$sentencia->execute();


$lista_servicios = $sentencia ->fetchAll(PDO::FETCH_ASSOC);








?>

<h2 class="text-center mt-5 mb-3">Listar Servicios</h2>


<div class="card">
    
    <div class="card-header">
    <a name="" id="" class="btn btn-success mt-2" href="crear.php" role="button">Agregar Registro</a>
        <h5 class="mt-3">Servicios</h5>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Icono</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_servicios as $servicios) { ?>
                    <tr class="">
                        <td><?php echo $servicios["id"] ?></td>
                        <td><?php echo $servicios["icono"] ?></td>
                        <td><?php echo $servicios["titulo"] ?></td>
                        <td><?php echo $servicios["descripcion"] ?></td>
                        <td>
                            <a name="" id="" class="btn btn-primary" href="editar.php?txtid=<?php echo $servicios["id"]; ?>" role="button">Editar</a> 
                            
                            <a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $servicios["id"]; ?>" role="button">Eliminar</a>
                            
                            
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>



<?php include("../../templates/footer.php"); ?>