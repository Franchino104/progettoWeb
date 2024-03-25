<?php
session_start();


$servername="localhost";
$username= "root";
$password= "";
$dbname= "biblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("errore di connessione: ". $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $email = $_POST["email"];

    $sql = "INSERT INTO utente ( Nome, Cognome, Email) values ('$nome', '$cognome', '$email')";
    $result = $conn->query($sql);

   
    if(!$result){
        echo "errore " . $conn->error;}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento utente</title>
    
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="inserimento.php">Inserisci libro</a></li>
        
        <li><a href="Prestito.php">Inserisci prestito o inserisci libro</a></li>
        <li><a href="ricerca.php">Cerca libro</a></li>


    <h1>REGISTRAZIONE</h1>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome"><br>
        <label for="cognome">Cognome: </label>
        <input type="text" name="cognome" id="cognome"><br>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email"><br>
        <input type="submit" name="registrati" id="registrati" value="Registrati">
<br><br><br>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sql = "SELECT Id_utente FROM utente ORDER BY Id_utente DESC LIMIT 1";        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "\t Il tuo Id univoco: " . $row["Id_utente"];
        }
    }
    ?>
    </form>
</body>
</html>