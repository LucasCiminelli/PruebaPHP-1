<?php include("../../templates/header.php"); 

include("../../bd.php");

include("../equipo/eliminar.php");


$sentencia = $conexion ->prepare("SELECT * FROM `tbl_equipo`");

$sentencia -> execute();

$lista_equipo = $sentencia ->fetchAll(PDO::FETCH_ASSOC);




?>

<h2 class="text-center mt-5 mb-3">Listar Equipo</h2>





<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-success mt-2" href="crear.php" role="button">Agregar Miembro del equipo</a>
    <h5 class="mt-3">Entradas Equipo</h5>

    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imágen</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Redes Sociales</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_equipo as $miembro){   ?>
                    <tr class="">
                        <td><?php echo $miembro["id"]; ?></td>
                        <td scope="col"><img width="50" src="../../../assets/img/team/<?php echo $miembro["imagen"];?>" alt=""></td>
                        <td><?php echo $miembro["nombrecompleto"]; ?></td>
                        <td><?php echo $miembro["puesto"]; ?></td>
                        <td scope="col">
                            <?php echo $miembro["twitter"]; ?>
                            <br/><?php echo $miembro["facebook"]; ?>
                            <br/><?php echo $miembro["linkedin"]; ?>
                        </td>
                        <td>
                        <a name="" id="" class="btn btn-primary" href="editar.php?txtid=<?php echo $miembro["id"]; ?>" role="button">Editar</a> 
                            
                            <a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $miembro["id"]; ?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>


<?php include("../../templates/footer.php"); ?>