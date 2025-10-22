<?php
require_once '../config/loader.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Create Pokemon</title>
    </head>
    <body>
    <h1>Create Pokemon</h1>
    <form method="POST" action="">
        <label>Pokemon: </label>
        <input type="text" name="pokemon_name" placeholder="Pokemon name"><br>

        <label for="type">Typ wählen: </label>
        <select name="type" id="type" required>
            <option value="Grass">Grass</option>
            <option value="Fire">Fire</option>
            <option value="Water">Water</option>
            <option value="Bug">Bug</option>
            <option value="Normal">Normal</option>
            <option value="Poison">Poison</option>
            <option value="Electric">Electric</option>
            <option value="Ground">Ground</option>
            <option value="Fairy">Fairy</option>
            <option value="Fighting">Fighting</option>
            <option value="Psychic">Psychic</option>
            <option value="Rock">Rock</option>
            <option value="Ghost">Ghost</option>
        </select><br>

        <label for="cought">cought!: </label>
        <select name="cought" id="cought" required>
            <option value="1">Yeah!</option>
            <option value="0">No</option>
        </select><br>
        <input type="submit" value="Submit">

    </form>
    </body>
    </html>

    <?php




}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name_pokemon = $_POST['pokemon_name'];
    $type_pokemon = $_POST['type'];
    $cought = $_POST['cought'];
    $conn = dbconnect();
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
