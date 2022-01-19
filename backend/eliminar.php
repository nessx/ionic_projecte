<?php
    include "config.php";
    $response = array();

    $id = $_POST["id"];
    $imagen = $_POST["imagen"];

    $sql = "DELETE FROM `pokemons` WHERE `id`=$id";
    $result = mysqli_query($con, $sql);

    if($result){
        // Use unlink() function to delete a file 
        if (!unlink($imagen)) { 
            $response["message"] =  $imagen." no se ha eliminado"; 
        } 
        else { 
            $response["message"] =  $imagen." se elimino junto al contenido de la tabla"; 
        } 

    }else{
        $response["message"] = "ERROR";
    }

    echo json_encode($response);
?>