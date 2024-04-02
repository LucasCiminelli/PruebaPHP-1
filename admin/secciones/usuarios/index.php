<?php include("../../templates/header.php"); 

include("../../bd.php");

include("../usuarios/eliminar.php");


$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");

$sentencia -> execute();

$lista_usuarios = $sentencia -> fetchAll(PDO::FETCH_ASSOC);



?>




<h2 class="text-center mt-5 mb-3">Listar Usuarios</h2>




<div class="card">
    
    <div class="card-header">
    <a name="" id="" class="btn btn-success mt-2" href="crear.php" role="button">Agregar Usuario</a>
        <h5 class="mt-3">Usuarios</h5>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_usuarios as $usuario) {  ?>
                    <tr class="">
                        <td><?php echo $usuario["id"]; ?></td>
                        <td><?php echo $usuario["usuario"]; ?></td>
                        <td><?php echo $usuario["correo"]; ?></td>
                        <td><?php echo $usuario["password"]; ?></td>
                        <td>
                            <a name="" id="" class="btn btn-primary" href="editar.php?txtid=<?php echo $usuario["id"]; ?>" role="button">Editar</a> 
                            
                            <a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $usuario["id"]; ?>" role="button">Eliminar</a>
                            
                            
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>



<?php include("../../templates/footer.php"); ?>