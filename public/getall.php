<?php
require_once '../config/loader.php';
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pokeapi.co/api/v2/pokemon?limit=150',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);
//echo $response;
var_dump($response);

//
//    $data = json_decode($response, true);
//
//    $con = dbConnect();
//
//    $sql = 'INSERT INTO pokemon (name, caught) VALUES (:name_pokemon, 0)';
//    $stmt = $con->prepare($sql);
//
//    foreach ($data['results'] as $pokemon) {
//        $name = $pokemon['name'];
//        $stmt->bindParam(':name_pokemon', $name);
//        $stmt->execute();
//    }