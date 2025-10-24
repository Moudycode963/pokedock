<?php
require_once '../config/loader.php';
# ---  Daten abrufen ---
$array = findAll('pokemon');
require_once '../html/read.html';