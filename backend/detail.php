<?php
    include "config.php";
    $id = $_POST["id"];

    $sql = "SELECT * FROM pokemons WHERE id=$id";
    $result = $con->query($sql);

    $response = array();

    if ($result && $result->num_rows > 0) {
        while($product_array = $result->fetch_assoc()) {
            $response[] = $product_array;
        }
    }
    echo json_encode($response);

?>