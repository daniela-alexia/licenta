<?php // connectare bazadedate
include("ConectareInstrumente.php");
//Modificare datelor
// se preia id din pagina vizualizare
$error='';
if (!empty($_POST['id']))
{ if (isset($_POST['submit']))
{ // verificam daca id-ul din URL este unul valid
    if (is_numeric($_POST['id']))
    { // preluam variabilele din URL/form
        $id_instrumente = $_POST['id_instrumente'];
        $nume = htmlentities($_POST['nume'], ENT_QUOTES);
        $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
        $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
        $categorie = htmlentities($_POST['categorie'], ENT_QUOTES);
        $pret = htmlentities($_POST['pret'], ENT_QUOTES);
    
        
        
// verificam daca numele, prenumele, an si grupa nu sunt goale
        if ($nume == '' || $imagine== ''|| $descriere=='' || $categorie== '' || $pret== '')
        { // daca sunt goale afisam mesaj de eroare
            echo "<div> ERROR: Completati campurile obligatorii!</div>";
        }else
        { // daca nu sunt erori se face update name, code, image, price, descriere, categorie
            if ($stmt = $mysqli->prepare("UPDATE instrumente SET nume=?,imagine=?,descriere=?,categorie=?,pret=? WHERE id_instrumente='".$id_instrumente."'"))
            {
                $stmt->bind_param("ssssd", $nume, $imagine, $descriere, $categorie, $pret);
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
    </style><title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<body>
<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <?php if ($_GET['id'] != '') { ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <p>ID: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM instrumente where id_instrumente='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?></p>
        <strong>Id instrumente: </strong> <input type="text" name="id_instrumente" value="<?php echo$row->id_instrumente;
        ?>"/><br/>
        <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->nume;
        ?>"/><br/>
        <strong>Imagine: </strong> <input type="text" name="imagine" value="<?php echo$row->imagine;
        ?>"/><br/>
        <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo$row->descriere;
        ?>"/><br/>
        <strong>Categorie: </strong> <input type="text" name="categorie" value="<?php echo$row->categorie;
        ?>"/><br/>
        <strong>Pret: </strong> <input type="text" name="pret" value="<?php echo$row->pret;}}} ?>"/><br/>
        
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="VizualizareInstrumente.php">Index</a>
    </div></form></body> </html>
