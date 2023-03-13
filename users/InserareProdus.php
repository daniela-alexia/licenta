<?php
include("ConectareProdus.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular

 $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
  $nume_produs = htmlentities($_POST['nume_produs'], ENT_QUOTES);
  $id_categorie_produs = htmlentities($_POST['id_categorie_produs'], ENT_QUOTES);

 


// verificam daca sunt completate
if ($descriere==''|| $nume_produs=='' || $id_categorie_produs)
{
// daca sunt goale se afiseaza un mesaj
$error = 'ERROR: Campuri goale!';
} else {
// insert
if ($stmt = $mysqli->prepare("INSERT into produs (descriere,nume_produs,id_categorie_produs) VALUES (?, ?, ?)"))
{
$stmt->bind_param("ssi", $descriere,$nume_produs, $id_categorie_produs);
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
    </style><title><?php echo "Inserare produs"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> <body>
<h1><?php echo "Inserare produs"; ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>
<strong>Nume produs: </strong> <input type="text" name="nume_produs" value=""/><br/>
<strong>Id categorie produs: </strong> <input type="text" name="id_categorie_produs" value=""/><br/>




<br/>
<input type="submit" name="submit" value="Submit" />
<a href="VizualizareProdus.php">Index</a>
</div></form></body></html>