<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConectareProduse</title>
</head>

<body>
    <?php
    $hostname = 'localhost';
    $username = 'root';
    $password = 'root';
    $db = 'Scoala_de_muzica';
    $mysqli = new mysqli($hostname, $username, $password, $db);

    if (!mysqli_connect_errno()) {
        echo 'S-a realizat conectarea la baza de date: ' . $db;
    } else {
        echo 'Nu se poate realiza conectarea la baza de date: ' . $db;
        exit();
    }

    ?>

</body>

</html>