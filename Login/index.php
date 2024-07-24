<?php
//admin hvantman123
session_start();
require "../connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Hi <?= $_SESSION['username']?></h3>
</body>
</html>