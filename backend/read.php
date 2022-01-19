<?php
    include "config.php";

    $sql = "SELECT * FROM pokemons";
    $result = $con->query($sql);

    $response = array();

    if ($result && $result->num_rows > 0) {
        while($product_array = $result->fetch_assoc()) {
            $response[] = $product_array;
        }
    }
    echo json_encode($response);

?>