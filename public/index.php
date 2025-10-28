<?php
// Lädt alle notwendigen Konfigurationsdateien, z. B. Datenbankverbindung oder Autoloader
include '../config/loader.php';

// Zerlegt die aktuelle URL in einzelne Teile (z. B. /api/pokemon/5 → ["", "api", "pokemon", "5"])
$request = explode('/', $_SERVER['REQUEST_URI']);

// Weist die einzelnen Teile der URL Variablen zu
$entity = $request[1] ?? null; // z. B. "api"
$method = $request[2] ?? null; // z. B. "pokemon"
$id = $request[3] ?? null;     // z. B. "5"


// Prüft, ob es sich um eine API-Anfrage handelt
if ($entity === 'api') {
    // Wenn ja, setze $entity auf die Ressource (z. B. "pokemon")
    $entity = $request[2];
    // Bestimme die HTTP-Methode (GET, POST, PUT, DELETE)
    $method = $_SERVER['REQUEST_METHOD'];
    // Hole ggf. die ID aus der URL
    $id = $request[3] ?? null;

    // Behandle die Anfrage abhängig von der HTTP-Methode
    switch ($method) {
        // --- GET: Daten abrufen ---
        case 'GET':
            if ($id) {
                // Wenn eine ID vorhanden ist → einzelnes Pokémon abrufen
                $conn = dbcon();
                $sql = "SELECT * FROM pokemon where id = :id;";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Antwort als JSON zurückgeben
                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                break;
            } else {
                // Wenn keine ID → alle Pokémon abrufen
                $conn = dbcon();
                $sql = "SELECT * FROM pokemon;";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                break;
            }

        // --- POST: Neues Pokémon erstellen ---
        case 'POST':
            $conn = dbcon();
            $sql = "INSERT INTO pokemon (name, caught, type) VALUES (:name, :caught, :type)";
            $stmt = $conn->prepare($sql);

            // $_POST enthält die gesendeten Formulardaten
            $stmt->execute($_POST);

            // Erfolgsstatus: 201 (Created)
            http_response_code(201);
            break;

        // --- PUT: Pokémon-Daten aktualisieren ---
        case "PUT":
            // Liest den Request Body (JSON) und wandelt ihn in ein PHP-Array um
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);

            $conn = dbcon();
            $sql = "UPDATE pokemon set name= :name, caught = :caught, type= :type where id=:id";
            $stmt = $conn->prepare($sql);

            // Führt das Update mit den gesendeten Daten aus
            $stmt->execute($data);

            // Erfolgsstatus: 201 (Created)
            http_response_code(201);
            break;

        // --- DELETE: Pokémon löschen ---
        case 'DELETE':
            $conn = dbcon();
            $sql = "DELETE FROM pokemon where id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            header('Content-Type: application/json');
            // Erfolgsstatus: 204 (No Content)
            http_response_code(204);
            break;
    }

} else {
    // Wenn es keine API-Anfrage ist → normale Webseiten-Logik
    switch ($method) {
        case '':
            echo 'Welcome'; // Startseite
            break;
        case 'create':
            require_once '../src/pokemon/create.php'; // Seite zum Erstellen eines Pokémon
            break;
        case 'index':
            require_once '../src/pokemon/read.php'; // Liste aller Pokémon
            break;
        case 'show':
            require_once '../src/pokemon/show.php'; // Einzelnes Pokémon anzeigen
            break;
        case 'update':
            require_once '../src/pokemon/update.php'; // Update-Seite
            break;
        case 'delete':
            require_once '../src/pokemon/delete.php'; // Delete-Seite
            break;
        default:
            echo 404; // Fehlerseite
    }
}
