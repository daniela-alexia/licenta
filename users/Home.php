<?php
// We need to use sessions, so you should always start sessions using thebelow code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
header('Location: Index.html');
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
        body {
            background-color: seashell;
            color: black;
            font-size: 30px;
            text-align: center;
        

            
        }
    </style>
<meta charset="utf-8">
<title>Pagina proiect parola</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet"
href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
<nav class="navtop">
<div>
<h2>Scoală de Muzică</h2>
<a href="VizualizareCurs.php"><i class="fas fa-usercircle"></i>Vizualizare cursuri</a>
<br>
<a href="VizualizareInstrumente.php"><i class="fas fa-usercircle"></i>Vizualizare instrumente</a>
<br>
<a href="VizualizareProdus.php"><i class="fas fa-usercircle"></i>Vizualizare comandă produse</a>
<br>
<a href="VizualizareProfesor.php"><i class="fas fa-usercircle"></i>Vizualizare comandă profesori</a>
<br>
<a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
</div>
</nav>
<div class="content">

<p>Bine ați revenit, <?=$_SESSION['name']?>!</p>
</div>
</body>
</html>
