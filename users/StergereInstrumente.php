<?php
// conectare la baza de date database
include("ConectareInstrumente.php");
// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// preluam variabila 'id' din URL
$id_instrumente = $_GET['id'];
// stergem inregistrarea cu ib=$id
if ($stmt = $mysqli->prepare("DELETE FROM instrumente WHERE id_instrumente = ? LIMIT 1"))
{
$stmt->bind_param("i",$id_instrumente);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: Nu se poate executa delete.";
}
$mysqli->close();
echo "<div>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p><a href=\"VizualizareInstrumente.php\">Index</a></p>";
?>
