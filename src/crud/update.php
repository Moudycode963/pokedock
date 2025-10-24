<?php
global $id;
require_once "../config/loader.php";

// DB-Verbindung
$pdo = dbConnect();

// 1️ Pokémon-Daten laden
$pokemon = findById('pokemon', $id);
if (!$pokemon) die("Pokémon nicht gefunden.");

// 2️ Formular verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? $pokemon['name'];
    $type = $_POST['type'] ?? $pokemon['type'];
    $caught = isset($_POST['caught']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE pokemon SET name = :name, type = :type, caught = :caught WHERE id = :id");
    $stmt->execute([
        ':name' => $name,
        ':type' => $type,
        ':caught' => $caught,
        ':id' => $id
    ]);

    header("Location: /pokemon/show/$id");
    exit;
}

// 3 Typen für das Dropdown
$types = ['Grass','Fire','Water','Bug','Normal','Poison','Electric','Ground','Fairy','Fighting','Psychic','Rock','Ghost'];
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Update <?= htmlspecialchars($pokemon['name']) ?></title>
</head>
<body>
<h1>Pokémon bearbeiten: <?= htmlspecialchars($pokemon['name']) ?></h1>

<form method="post">
    <label>
        Name:<br>
        <input type="text" name="name" value="<?= htmlspecialchars($pokemon['name']) ?>" required>
    </label>
    <br><br>

    <label>
        Typ:<br>
        <select name="type" required>
            <?php foreach($types as $t): ?>
                <option value="<?= $t ?>" <?= $pokemon['type'] === $t ? 'selected' : '' ?>><?= $t ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <br><br>

    <label>
        caught ?
        <input type="checkbox" name="caught" value="1" <?= $pokemon['caught'] ? 'checked' : '' ?>>
    </label>
    <br><br>

    <button type="submit">update</button>
    <a href="/pokemon/show/<?= $id ?>">zurück</a>
</form>
</body>
</html>
