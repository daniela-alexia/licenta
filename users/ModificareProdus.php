<?php // connectare bazadedate
include("ConectareProdus.php");
//Modificare datelor
// se preia id din pagina vizualizare
$error='';
if (!empty($_POST['id_produs']))
{ if (isset($_POST['submit']))
{ // verificam daca id-ul din URL este unul valid
    if (is_numeric($_POST['id_produs']))
    { // preluam variabilele din URL/form
        $id_produs = $_POST['id_produs'];
        $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
        $nume_produs = htmlentities($_POST['nume_produs'], ENT_QUOTES);
        $id_categorie_produs = htmlentities($_POST['id_categorie_produs'], ENT_QUOTES);

    
        
        
// verificam daca numele, prenumele, an si grupa nu sunt goale
        if ($descriere==''|| $numeprodus=='' || $id_categorie_produs)
        { // daca sunt goale afisam mesaj de eroare
            echo "<div> ERROR: Completati campurile obligatorii!</div>";
        }else
        { // daca nu sunt erori se face update name, code, image, price, descriere, categorie
            if ($stmt = $mysqli->prepare("UPDATE produs SET descriere=?,nume_produs=?,descriere=?,categorie=?,pret=? WHERE id_produs='".$id_produs."'"))
            {
                $stmt->bind_param("ssi", $descriere,$nume_produs, $id_categorie_produs);
                $stmt->execute();
                $stmt->close();
            }// mesaj de eroare in caz ca nu se poate face update
            else
            {echo "ERROR: nu se poate executa update.";}
        }
    }
// daca variabila 'id' nu este valida, afisam mesaj de eroare
    else
    {echo "id incorect!";} }}?>
<html> <head>
<style>
        body {
            background-color: seashell;
            color: black;
        }
    </style><title> <?php if ($_GET['id_produs'] != '') { echo "Modificare inregistrare"; }?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<body>
<h1><?php if ($_GET['id_produs'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <?php if ($_GET['id_produs'] != '') { ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id_produs'];?>" />
        <p>ID: <?php echo $_GET['id_produs'];
            if ($result = $mysqli->query("SELECT * FROM produs where id_produs='".$_GET['id_produs']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?></p>
        <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo$row->descriere;
        ?>"/><br/>
        <strong>Nume produs: </strong> <input type="text" name="nume_produs" value="<?php echo$row->nume_produs;
        ?>"/><br/>
        <strong>Id categorie produs: </strong> <input type="text" name="id_categorie_produs" value="<?php echo$row->id_categorie_produs;
        ?>"/><br/>}}} ?>"/><br/>
        
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="VizualizareProdus.php">Index</a>
    </div></form></body> </html>
