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


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['invio'])){
    $id_libro = $_POST["id_libro"];
    $id_utente = $_POST["id_utente"];
    $dataInizio = date('Y-m-d');
    $dataFine = $_POST["dataFine"];

    $sql = "INSERT INTO prestiti (Id_libro, Id_utente, dataI, dataF) values ('$id_libro', '$id_utente', '$dataInizio', '$dataFine')";
    $result = $conn->query($sql);

    if(!$result){echo "errore  " . $conn->error;}
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['invio1'])){
    $id_libro = $_POST["id_libro"];
    $id_utente = $_POST["id_utente"];
    

    $sql = "DELETE FROM prestiti WHERE Id_libro='$id_libro'";
    $result = $conn->query($sql);

    if(!$result){echo "errore  " . $conn->error;}
}
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento libri</title>
   
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="inserimento.php">Inserisci libro</a></li>
        <li><a href="registrazione.php">Registrati</a></li>
    
        <li><a href="ricerca.php">Cerca libro</a></li>

    <br><br>
    <h1>INSERISCI PRESTITO</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <label for="id_libro">Id libro: </label>
        <input type="text" name="id_libro" id="id_libro"><br>
        <label for="id_utente">Id utente: </label>
        <input type="text" name="id_utente" id="id_utente"><br>
        <label for="dataFine">Data fine prestito: </label>
        <input type="date" name="dataFine" id="dataFine"><br>
       
        <input type="submit" name="invio" id="invio" value="Inserisci prestito">
    </form>
    <h1>RESTITUISCI LIBRO</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <label for="id_libro">Id libro: </label>
        <input type="text" name="id_libro" id="id_libro"><br>
        <label for="id_utente">Id utente: </label>
        <input type="text" name="id_utente" id="id_utente"><br>
        
       
        <input type="submit" name="invio1" id="invio1" value="Restituisci">
    </form>
</body>
</html>