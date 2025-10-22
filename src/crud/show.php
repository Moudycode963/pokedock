<?php

global $id;
require_once "../config/loader.php";

$data = findById('pokemon',$id);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Poki</title>
</head>
<body>

<div><?= $data['id']?></div>
<div><?= $data['name']?></div>
<div><?=$data['caught']?></div>


<a href='/pokemon/update/<?= $id ?>'>Update</a>
<a href='/pokemon/delete/<?= $id ?>'>delete</a>

</body>
</html>
