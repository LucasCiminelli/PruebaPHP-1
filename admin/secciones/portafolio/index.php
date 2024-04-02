<?php include("../../templates/header.php"); 


include("../../bd.php");

include("../portafolio/eliminar.php");


$sentencia = $conexion -> prepare("SELECT * FROM `tbl_portafolio`");

$sentencia->execute();


$lista_portafolio = $sentencia ->fetchAll(PDO::FETCH_ASSOC);




?>

<h2 class="text-center mt-5">Listar Portfolio</h2>



<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success mt-2" href="crear.php" role="button">Agregar Registro</a>
        <h5 class="mt-3">Portafolio</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Título</th>
                        <th scope="col">Subtítulo</th>
                        <th scope="col">Imágen</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Url</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_portafolio as $portafolio) { ?>
                    <tr class="">
                        <td scope="col"><?php echo $portafolio["id"];  ?></td>
                        <td scope="col"><?php echo $portafolio["titulo"];  ?></td>
                        <td scope="col"><?php echo $portafolio["subtitulo"];  ?></td>
                        <td scope="col"><img width="50" src="../../../assets/img/portfolio/<?php echo $portafolio["imagen"];  ?>" alt=""></td>
                        <td scope="col"><?php echo $portafolio["descripcion"];  ?></td>
                        <td scope="col"><?php echo $portafolio["cliente"];  ?></td>
                        <td scope="col"><?php echo $portafolio["categoria"];  ?></td>
                        <td scope="col"><?php echo $portafolio["url"];  ?></td>
                        <td scope="col">
                            <a name="" id="" class="btn btn-primary" href="editar.php?txtid=<?php echo $portafolio["id"]; ?>" role="button">Editar</a> 
                            
                            <a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $portafolio["id"]; ?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>



<?php include("../../templates/footer.php"); ?>