<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<style>
        body {
            background-color: seashell;
            color: black;
        }
    </style>
<title>Vizualizare Inregistrari</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela Produs</h1>
<p><b><br></b></p>
<?php
// connectare bazadedate
 include("ConectareProdus.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM produs ORDER BY id_produs "))
{ // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
{
// afisarea inregistrarilor intr-o table
echo "<table border='1' cellpadding='10'>";
// antetul tabelului
echo "<tr><th>Id produs</th><th>Descriere</th><th>Nume produs</th><th>Id categorie produs</th><th></th><th></th></tr>";
while ($row = $result->fetch_object())
{
// definirea unei linii pt fiecare inregistrare
echo "<tr>";
echo "<td>" . $row->id_produs . "</td>";
echo "<td>" . $row->descriere . "</td>";
echo "<td>" . $row->nume_produs . "</td>";
echo "<td>" . $row->id_categorie_produs . "</td>";


echo "<td><a href='ModificareProdus.php?id=" . $row->id_produs . "'>Modificare</a></td>";
echo "<td><a href='StergereProdus.php?id=" .$row->id_produs . "'>Stergere</a></td>";
echo "</tr>";
}
echo "</table>";
}
// daca nu sunt inregistrari se afiseaza un rezultat de eroare
else
{
echo "Nu sunt inregistrari in tabela!";
}
}
// eroare in caz de insucces in interogare
else
{ echo "Error: " . $mysqli->error(); }
// se inchide
$mysqli->close();
?>
<a href="InserareProdus.php">Adaugarea unei noi inregistrari</a>
</body>
</html>