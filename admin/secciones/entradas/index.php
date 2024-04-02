<?php include("../../templates/header.php"); 

include("../../bd.php");

include("../entradas/eliminar.php");

$sentencia = $conexion -> prepare("SELECT * FROM `tbl_entradas`");

$sentencia -> execute();

$lista_entradas = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

?>

<h2 class="text-center mt-5">Listar Entrada</h2>


<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-success mt-2" href="crear.php" role="button">Agregar Registro</a>
    <h5 class="mt-3">Entradas Blog</h5>

    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Imágen</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach($lista_entradas as $entrada){  ?>
                    <tr class="">
                        <td><?php echo $entrada["id"]; ?></td>
                        <td><?php echo $entrada["fecha"]; ?></td>
                        <td><?php echo $entrada["titulo"]; ?></td>
                        <td><?php echo $entrada["descripcion"]; ?></td>
                        <td scope="col"><img width="50" src="../../../assets/img/portfolio/<?php echo $entrada["imagen"];  ?>" alt=""></td>
                        <td>
                            <a name="" id="" class="btn btn-primary" href="editar.php?txtid=<?php echo $entrada["id"]; ?>" role="button">Editar</a> 
                            
                            <a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $entrada["id"]; ?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>





<?php include("../../templates/footer.php"); ?>