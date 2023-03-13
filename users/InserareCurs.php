<?php
include("ConectareCurs.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular


        $nume = htmlentities($_POST['nume'], ENT_QUOTES);
        $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
        $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
        $pret = htmlentities($_POST['pret'], ENT_QUOTES);
        $instrument = htmlentities($_POST['instrument'], ENT_QUOTES);

// verificam daca sunt completate
if ($nume == '' || $imagine== ''|| $descriere=='' || $pret== '' || $instrument== '')
{
// daca sunt goale se afiseaza un mesaj
$error = 'ERROR: Campuri goale!';
} else {
// insert
if ($stmt = $mysqli->prepare("INSERT into curs (nume,imagine,descriere,pret,instrument) VALUES (?, ?, ?, ?, ?)"))
{
$stmt->bind_param("sssds", $nume, $imagine, $descriere, $pret, $instrument);
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
    </style><title><?php echo "Inserare curs"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> <body>
<h1><?php echo "Inserare curs"; ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>

<strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>

<strong>Imagine: </strong> <input type="text" name="imagine" value=""/><br/>
<strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>
<strong>Preț: </strong> <input type="text" name="pret" value=""/><br/>
<strong>Instrument: </strong> <input type="text" name="instrument" value=""/><br/>

<br/>
<input type="submit" name="submit" value="Submit" />
<a href="VizualizareCurs.php">Index</a>
</div></form></body></html>