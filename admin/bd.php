<?php 


    $servidor="localhost";
    $bd = "website";
    $usuario = "root";
    $password = "";



    try{

        $conexion = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $password);


    }catch(Exception $error){
        echo $error -> getMessage();

    }


?>