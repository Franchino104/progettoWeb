<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("errore di connessione: ". $conn->connect_error);
}

$sql = "SELECT libri.titolo AS titolo, prestiti.dataI, prestiti.dataF
        FROM prestiti
        INNER JOIN libri ON prestiti.id_libro = libri.id_libro";
$result = $conn->query($sql);


?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Magnabosco</title>
    
</head>
<body>
    
<ul>
    <li><a href="inserimento.php">Inserisci libro</a></li>
  <li><a href="registrazione.php">Registrati</a></li>
  <li><a href="Prestito.php">Inserisci prestito o restituisci libro</a></li>
  <li><a href="ricerca.php">Cerca libro</a></li><br>
</ul>
<h1>TABELLA PRESTITI EFFETTUATI</h1>
<?php
if ($result->num_rows > 0) {
    echo "<ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>";
    echo "Titolo libro: " . $row["titolo"] . "<br>";
    echo "Inizio prestito: " . $row["dataI"] . "<br>";
    echo "Fine prestito: " . $row["dataF"];
    echo "</li>";
    echo 'CHE SCHIFO GIULIA, ovviamente si scherza, forse';
}
}
?>
<h1>PRESTITI SCADUTI</h1>
<?php
$sql2 = "SELECT libri.titolo AS titolo
FROM prestiti
INNER JOIN libri ON prestiti.Id_libro = libri.id_libro
WHERE prestiti.dataF <= CURDATE()";
$result2 = $conn->query($sql2);

$sql1 = "SELECT utente.Nome AS Nome
FROM utente
INNER JOIN prestiti ON utente.Id_utente=prestiti.Id_utente";


$result1 = $conn->query($sql1);

if ($result2->num_rows > 0 && $result1->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc() && $row1 = $result1->fetch_assoc()) {
        
           
        echo "<li>". $row1['Nome']." devi consegnare il libro ". $row2['Titolo'] . "</li>";
   
    }
} else {
    echo "<li>Nessun libro scaduto.</li>";
}
?>

<h1>EMAIL UTENTI CON PIU' DI 5 PRESTITI</h1>
<?php
$sql = "SELECT utente.Email AS Email
FROM utente
INNER JOIN prestiti ON prestiti.Id_utente = utente.id_utente
WHERE (SELECT COUNT(libri.genere)
FROM libri
INNER JOIN prestiti ON prestiti.Id_libro = libri.id_libro
WHERE COUNT(libri.genere)>=5)";
$result = $conn->query($sql);
$sql1 = "SELECT utente.Nome AS Nome
FROM utente
INNER JOIN prestiti ON utente.Id_utente=prestiti.Id_utente";


$result1 = $conn->query($sql1);

if ($result->num_rows > 0 && $result1->num_rows > 0) {
    while ($row = $result->fetch_assoc() && $row1 = $result1->fetch_assoc()) {
        
           
        echo "<li>". $row1['Nome']." devi consegnare il libro ". $row['titolo'] . "</li>";
   
    }
} else {
    echo "<li>Nessun utente ha più di cinque prestiti.</li>";
}
?>

</body>
</html>

