<?php
include("ConectareProfesor.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular


        $nume = htmlentities($_POST['nume'], ENT_QUOTES);
        $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
        $email = htmlentities($_POST['email'], ENT_QUOTES);
        $telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
        $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
        $instrument = htmlentities($_POST['instrument'], ENT_QUOTES);

// verificam daca sunt completate
if ($nume == '' || $prenume== ''|| $email=='' || $telefon== '' || $imagine== '' || $instrument== '')
{
// daca sunt goale se afiseaza un mesaj
$error = 'ERROR: Campuri goale!';
} else {
// insert
if ($stmt = $mysqli->prepare("INSERT into profesor (nume,prenume,email,telefon,imagine,instrument) VALUES (?, ?, ?, ?, ?, ?)"))
{
$stmt->bind_param("sssiss", $nume, $prenume, $email, $telefon, $imagine, $instrument);
$stmt->execute();
$stmt->close();
}
// eroare le inserare
else
{
echo "ERROR: Nu se poate executa insert.";
}
}
}
// se inchide conexiune mysqli
$mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<style>
        body {
            background-color: seashell;
            color: black;
        }
    </style><title><?php echo "Inserare profesor"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> <body>
<h1><?php echo "Inserare profesor"; ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>

<strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>

<strong>Prenume: </strong> <input type="text" name="prenume" value=""/><br/>
<strong>Email: </strong> <input type="text" name="email" value=""/><br/>
<strong>Telefon: </strong> <input type="text" name="telefon" value=""/><br/>
<strong>Imagine: </strong> <input type="text" name="imagine" value=""/><br/>
<strong>Instrument: </strong> <input type="text" name="instrument" value=""/><br/>

<br/>
<input type="submit" name="submit" value="Submit" />
<a href="VizualizareProfesor.php">Index</a>
</div></form></body></html>