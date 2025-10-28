<?php
require_once '../config/loader.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

require_once '../html/create.html';

}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name_pokemon = $_POST['pokemon_name'];
    $type_pokemon = $_POST['type'];
    $cought = $_POST['cought'];
    $conn = dbcon();
    $sql = "INSERT INTO pokemon (name, caught, type) VALUES (:name_pokemon,:cought,:type)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name_pokemon', $name_pokemon);
    $stmt->bindParam(':type', $type_pokemon);
    $stmt->bindparam(':cought', $cought);
    $stmt->execute();
    echo "Pokemon created successfully";


}


//
//
//
//
//
?>
