<?php // connectare bazadedate
include("ConectareProfesor.php");
//Modificare datelor
// se preia id din pagina vizualizare
$error='';
if (!empty($_POST['id']))
{ if (isset($_POST['submit']))
{ // verificam daca id-ul din URL este unul valid
    if (is_numeric($_POST['id']))
    { // preluam variabilele din URL/form
        $id_profesor = $_POST['id_profesor'];
        $nume = htmlentities($_POST['nume'], ENT_QUOTES);
        $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
        $email = htmlentities($_POST['email'], ENT_QUOTES);
        $telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
        $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
        $instrument = htmlentities($_POST['instrument'], ENT_QUOTES);

    
        
        
// verificam daca numele, prenumele, an si grupa nu sunt goale
        if ($nume == '' || $prenume== ''|| $email=='' || $telefon== '' || $imagine== '' || $instrument== '')
        { // daca sunt goale afisam mesaj de eroare
            echo "<div> ERROR: Completati campurile obligatorii!</div>";
        }else
        { // daca nu sunt erori se face update name, code, image, price, descriere, categorie
            if ($stmt = $mysqli->prepare("UPDATE profesor SET nume=?,prenume=?,email=?,telefon=?,imagine=?,instrument=? WHERE id_profesor='".$id_profesor."'"))
            {
                $stmt->bind_param("sssiss", $nume, $prenume, $email, $telefon, $imagine, $instrument);
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
            if ($result = $mysqli->query("SELECT * FROM profesor where id_profesor='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?></p>
        <strong>Id profesor: </strong> <input type="text" name="id_profesor" value="<?php echo$row->id_profesor;
        ?>"/><br/>
        <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->nume;
        ?>"/><br/>
        <strong>Prenume: </strong> <input type="text" name="prenume" value="<?php echo$row->prenume;
        ?>"/><br/>
        <strong>Email: </strong> <input type="text" name="email" value="<?php echo$row->email;
        ?>"/><br/>
        <strong>Telefon: </strong> <input type="text" name="telefon" value="<?php echo$row->telefon;
        ?>"/><br/>
        <strong>Imagine: </strong> <input type="text" name="imagine" value="<?php echo$row->imagine;
        ?>"/><br/>
        <strong>Instrument: </strong> <input type="text" name="instrument" value="<?php echo$row->instrument;}}}?>"/><br/>
        
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="VizualizareProfesor.php">Index</a>
    </div></form></body> </html>
