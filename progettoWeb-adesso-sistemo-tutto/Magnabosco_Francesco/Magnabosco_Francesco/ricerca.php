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





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="inserimento.php">Inserisci libro</a></li>
        <li><a href="registrazione.php">Registrati</a></li>
        <li><a href="Prestito.php">Inserisci prestito o restituisci libro</a></li>
      </ul>
    <br><br>
    <h1>RICERCA LIBRO</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <label for="titolo">Ricerca titolo: </label>
        <input type="text" name="titolo" id="titolo">
        <input type="submit" name="tit" id="tit" value="ricerca titolo"><br>
        <label for="autore">Ricerca autore: </label>
        <input type="text" name="autore" id="autore">
        <input type="submit" name="aut" id="aut" value="ricerca autore"><br>
        <label for="genere">Ricerca genere: </label>
        <select name="genere" id="genere">
            <option value="narrativa">Narrativa</option>
            <option value="saggistica">Saggistica</option>
            <option value="fantascienza">Fantascienza</option>
            <option value="giallo">Giallo</option>
            <option value="storico">Storico</option>
            <option value="biografico">Biografico</option>
            <option value="Fantasy">Fantasy</option>
        </select>
        <input type="submit" name="gen" id="gen" value="ricerca genere"><br><br>
    </form>

    <?php
    if(isset($_POST["tit"])){
        $titolo= $_POST["titolo"];
        $sql="SELECT * FROM libri WHERE titolo='$titolo'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            echo "titolo: " . $row["titolo"]."<br>". " autore: " . $row["autore"]. "<br>"."anno di pubblicazione: " . $row["anno_pubblicazione"]."<br>". "genere: " . $row["genere"];
        }
    }

    if(isset($_POST["aut"])){
        $autore= $_POST["autore"];
        $sql="SELECT * FROM libri WHERE autore='$autore'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            echo "titolo: " . $row["titolo"]."<br>". " autore: " . $row["autore"]. "<br>"."anno di pubblicazione: " . $row["anno_pubblicazione"]."<br>". "genere: " . $row["genere"];
        }
    }

    if(isset($_POST["gen"])){
        $genere= $_POST["genere"];
        $sql="SELECT * FROM libri WHERE genere='$genere'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            echo "titolo: " . $row["titolo"]."<br>". " autore: " . $row["autore"]. "<br>"."anno  di pubblicazione: " . $row["anno_pubblicazione"]."<br>". "genere: " . $row["genere"];
        }
    }

    ?>
</body>
</html>