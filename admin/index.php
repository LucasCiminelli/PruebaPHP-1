<?php include("./templates/header.php"); 



?>



<div class="p-5 mb-4 bg-light rounded-3 mt-5">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bienvenido <?php echo $_SESSION["usuario"]; ?></h1>
        <p class="col-md-8 fs-4">
            A través de este sistema creado para ti, vas a poder configurar todas las secciones de tu webpage muy Fácilmente
        </p>
        <a href="./secciones/servicios/index.php"><button class="btn btn-primary btn-lg" type="button">
            ¡Comenzar ahora!
        </button></a>
        
    </div>
</div>





<?php include("./templates/footer.php");  ?>     
