<?php
// conectare la baza de date database
include("ConectareProfesor.php");
// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// preluam variabila 'id' din URL
$id_profesor = $_GET['id'];
// stergem inregistrarea cu ib=$id
if ($stmt = $mysqli->prepare("DELETE FROM profesor WHERE id_profesor = ? LIMIT 1"))
{
$stmt->bind_param("i",$id_profesor);
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
echo "<p><a href=\"VizualizareProfesor.php\">Index</a></p>";
?>
