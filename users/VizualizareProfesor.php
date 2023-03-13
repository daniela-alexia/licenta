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
<h1>Inregistrarile din tabela Profesor</h1>
<p><b><br></b></p>
<?php
// connectare bazadedate
 include("ConectareProfesor.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM profesor ORDER BY id_profesor "))
{ // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
{
// afisarea inregistrarilor intr-o table
echo "<table border='1' cellpadding='10'>";
// antetul tabelului
echo "<tr><th>Id profesor</th><th>Nume</th><th>Prenume</th><th>Email</th><th>Telefon</th><th>Imagine</th><th>Instrument</th><th></th><th></th></tr>";
while ($row = $result->fetch_object())
{
// definirea unei linii pt fiecare inregistrare
echo "<tr>";
echo "<td>" . $row->id_profesor . "</td>";
echo "<td>" . $row->nume . "</td>";
echo "<td>" . $row->prenume . "</td>";
echo "<td>" . $row->email . "</td>";
echo "<td>" . $row->telefon . "</td>";
echo "<td>" . $row->imagine . "</td>";
echo "<td>" . $row->instrument . "</td>";


echo "<td><a href='ModificareProfesor.php?id=" . $row->id_profesor . "'>Modificare</a></td>";
echo "<td><a href='StergereProfesor.php?id=" .$row->id_profesor . "'>Stergere</a></td>";
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
<a href="InserareProfesor.php">Adaugarea unei noi inregistrari</a>
</body>
</html>