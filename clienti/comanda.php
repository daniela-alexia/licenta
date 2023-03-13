<?php

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php'); //aici mare atentie conditia este cand nu esti logat sa te duca la idexl
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Pagina profil</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styleForAllPages.css">

</head>

<body>
    <div>
        <h2><i style="color: #594E40">
                <?= $_SESSION['name'] ?>
            </i>, comanda a fost plasata cu SUCCES!</h2>
        <div><a href="magazin.php">Inapoi</a></div>


    </div>
</body>

</html>