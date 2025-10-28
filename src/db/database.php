<?php

//require_once "../../config/loader.php";

// Datenbankverbindung aufbauen
function dbcon(): PDO
{
    $host = 'mariadb';
    $dbname = 'pokedex';
    $user = 'phpstorm';
    $pass = 'p@ssw0rt';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    return new PDO($dsn, $user, $pass, $options);
}

// Funktion: Alle Pokémon abrufen
function findAll(string $table): array
{
    $pdo = dbConnect();
    $stmt = $pdo->query("SELECT * FROM `$table`");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//  Funktion:  Pokémon abrufen bei ID
function findById(string $table, int $id): array{
    $pdo = dbConnect();
    $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE `id` = '$id'");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);

}
 // Funktion: Tabelle generieren
function createPokemonTable(array $data, string $farbe_1 = '#d0f0c0', string $farbe_2 = '#f0d0d0'): string
{
    if (empty($data)) {
        return "<p>Keine Pokémon gefunden.</p>";
    }

    $string = "<table border='1' cellspacing='0' cellpadding='5' style='border-collapse: collapse;'>";
    $string .= "<tr style='background-color: #ccc;'>";
    $string .= "<th>ID</th><th>Name</th><th>Type</th><th>Caught</th><th>Aktion</th>";
    $string .= "</tr>";

    foreach ($data as $index => $pokemon) {
        $color = ($index % 2 === 0) ? $farbe_1 : $farbe_2;

        $string .= "<tr style='background-color: $color'>";
        $string .= "<td>{$pokemon['id']}</td>";
        $string .= "<td>{$pokemon['name']}</td>";
        $string .= "<td>{$pokemon['type']}</td>";
        $string .= "<td>" . ($pokemon['caught'] ? '✅ Ja' : '❌ Nein') . "</td>";
        $string .= "<td style='background-color: white'>";
        $string .= "<a href='/pokemon/show/{$pokemon['id']}'>Anzeigen</a>";
        $string .= "</td>";
        $string .= "</tr>";

    }

    $string .= "</table>";
    return $string;
}



//
//$conn = new PDO("mysql:host=;dbname=pokedex", 'phpstorm', 'p@ssw0rt');
//$sql = 'SELECT * FROM pokemon';
//$stmt = $conn->prepare($sql);
//$stmt->execute();
//$pokemon = $stmt->fetchAll(PDO::FETCH_ASSOC);


//var_dump($pokemon);


