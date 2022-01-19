<?php
    include "config.php";
    $response = array();

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
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($imatge["tmp_name"], $target_file)) {
            $message = "The file ". htmlspecialchars(basename($imatge["name"])). " has been uploaded.";

            $sqlStmt ="INSERT INTO `pokemons` (`nombre`, `tipo`, `habilidades`, `tamano`, `imagen`) VALUES ('$nombre', '$tipo', '$habilidades', '$tamano', '$target_file')";

            $sql = mysqli_query($con, $sqlStmt);
            if($sql){
                $response["message"] = "OK";
            }else{
                $response["message"] = "KO";
            }

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