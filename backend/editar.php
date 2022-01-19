<?php
    include "config.php";
    $response = array();

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $habilidades = $_POST["habilidades"];
    $tamano = $_POST["tamano"];
    $imatge = $_FILES["imatge"];


    $target_dir = "uploads/";
    $extension_img = substr($imatge["name"], strripos($imatge["name"], '.'));
    $target_file = $target_dir . basename(generateRandomString().$extension_img);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //Check if file already exists
    if (file_exists($target_file)) {
        $message = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($imatge["size"] > 500000) {
        $message= "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        $message= "Sorry, only JPG, JPEG & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded.";
        $message = "Se ha subido sin imagen";
        $sqlStmt ="UPDATE `pokemons` SET `nombre`='$nombre', `tipo`='$tipo', `habilidades`='$habilidades', `tamano`='$tamano' WHERE `id`=$id";
        $sql = mysqli_query($con, $sqlStmt);
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($imatge["tmp_name"], $target_file)) {
            
            $sql_imagen = "SELECT imagen FROM `pokemons` WHERE id=$id";
            if($result = mysqli_query($con, $sql_imagen)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        if (!unlink($row[0])) { 
                            $message =  $row[0]." no se ha eliminado"; 
                        } 
                        else { 
                            $message =  $row[0]." se elimino junto al contenido de la tabla"; 
                        } 
                    }
                }else{
                    $message = "Imagen no eliminada!";
                }
            }

            $sqlStmt ="UPDATE `pokemons` SET `nombre`='$nombre', `tipo`='$tipo', `habilidades`='$habilidades', `tamano`='$tamano', `imagen`='$target_file' WHERE `id`=$id";
            $sql = mysqli_query($con, $sqlStmt);
            $message = "The file ". htmlspecialchars(basename($imatge["name"])). " has been uploaded.";
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    }

    $response["message"] = $message;

    echo json_encode($response);

    function generateRandomString($length = 15) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

?>