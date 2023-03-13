<?php
// Schimbați acest lucru cu informațiile despre conexiune.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'Scoala_de_muzica';
// Incerc sa ma conectez pe baza info de mai sus.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER,
$DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
// Dacă există o eroare la conexiune, opriți scriptul și afișați eroarea.
exit('Nu se poate conecta la MySQL:'  . mysqli_connect_error());
}
//.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['telefon'], $_POST['functie'])) {
// Nu s-au putut obține datele care ar fi trebuit trimise.
exit('Competati formularul de inregistrare !');
}
// Asigurați-vă că valorile înregistrării trimise nu sunt goale.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['telefon']) || empty($_POST['functie'])) {
// One or more values are empty.
exit('Complete registration form');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
exit('Email-ul nu este valid!');
}
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
 exit('Username-ul nu este valid!');
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Parola trebuie sa fie intre 5 si 20 charactere!');
}
if (strlen($_POST['telefon']) < 10 || strlen($_POST['telefon']) > 15 || !ctype_digit($_POST['telefon'])) {
  exit('Numarul de telefon trebuie sa contina intre 10 si 15 cifre!');
}
if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['client'])) {
        return "Clientul poate contine doar litere si cifre!";
    }
if (!preg_match('/^[a-zA-Z\s]+$/', $_POST['administrator'])) {
        return "Administratorul poate contine doar litere si spatii!";
    }

// verificam daca contul userului exista.
if ($stmt = $con->prepare('SELECT id_user, password FROM user WHERE username = ?')) {
// hash parola folosind funcția PHP password_hash.
$stmt->bind_param('s', $_POST['username']);
$stmt->execute();
$stmt->store_result();
// Memoram rezultatul, astfel încât să putem verifica dacă contul există în baza de date.
if ($stmt->num_rows > 0) {
// Username exista
echo 'Username-ul exista deja, alegeti altul!';
} else {
if ($stmt = $con->prepare ('INSERT INTO user (username, password, email, telefon, functie) VALUES (?, ?, ?, ?, ?)')) {
// Nu dorim să expunem parole în baza noastră de date, așa că hash parola și utilizați 
//password_verify atunci când un utilizator se conectează.
$password = password_hash($_POST['password'],
PASSWORD_DEFAULT);
$stmt->bind_param('sss', $_POST['username'], $password, $_POST['email'], $_POST['telefon'], $_POST['functie']);
$stmt->execute();
echo 'V-ați înregistrat cu succes!';
header('Location: index.html');
} else {
// Ceva nu este în regulă cu declarația sql, verificați pentru a vă asigura că tabelul conturilor 
//există cu toate cele 5 câmpuri.

echo 'Nu se poate face prepare statement!';
}
}
$stmt->close();
} else {
// Ceva nu este în regulă cu declarația sql, verificați pentru a vă asigura că tabelul conturilor 
//există cu toate cele 5 câmpuri.

echo 'Nu se poate face prepare statement!';
}
$con->close();
?>