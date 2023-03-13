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
<h1>Inregistrarile din tabela curs</h1>
<p><b><br></b></p>
<?php
// connectare bazadedate
 include("Conectare_clienti.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM curs ORDER BY id_curs "))
{ // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
{
// afisarea inregistrarilor intr-o table
echo "<table border='1' cellpadding='10'>";
// antetul tabelului
echo "<tr><th>Id curs</th><th>Nume Curs</th><th>Imagine</th><th>Descriere</th><th>Pret</th><th>Instrument</th></tr>";
while ($row = $result->fetch_object())
{
// definirea unei linii pt fiecare inregistrare
echo "<tr>";
echo "<td>" . $row->id_curs . "</td>";
echo "<td>" . $row->nume . "</td>";
echo "<td>" . $row->imagine . "</td>";
echo "<td>" . $row->descriere . "</td>";
echo "<td>" . $row->pret . "</td>";
echo "<td>" . $row->instrument . "</td>";


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

</body>
</html>