<?php

$request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$entity = $request[0] ?? null;   // z.B. "pokemon"
$method = $request[1] ?? '';     // z.B. "delete"
$id = isset($request[2]) ? (int)$request[2] : null; // z.B. 5

switch ($method) {
    case '':
        require_once "../view/index.php";
        break;
    case 'read':
        require_once "../src/crud/read.php";
        break;
    case 'create':
        require_once "../src/crud/create.php";
        break;
    case 'update':
        require_once "../src/crud/update.php";
        break;
    case 'delete':
        require_once "../src/crud/delete.php";
        break;
    case 'show':
        require_once "../src/crud/show.php";
        break;
    default:
        require_once "../view/404.html";
}