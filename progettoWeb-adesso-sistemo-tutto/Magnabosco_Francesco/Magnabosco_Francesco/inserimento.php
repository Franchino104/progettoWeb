<?php
//connessione al DB
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("errore di connessione: ". $conn->connect_error);
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titolo = $_POST["titolo"];
    $autore = $_POST["autore"];
    $anno_pubblicazione = $_POST["anno_pubblicazione"];
    $genere = $_POST["genere"];

    $sql = "INSERT INTO libri (titolo, autore, anno_pubblicazione, genere) values ('$titolo', '$autore', '$anno_pubblicazione', '$genere')";
    $result = $conn->query($sql);

    if(!$result){
        echo "errore " . $conn->error;}

        $sql1 = "SELECT * FROM libri WHERE titolo='$titolo' AND autore= '$autore'AND anno_pubblicazione='$anno_pubblicazione' AND genere='$genere'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            $row = $result1->fetch_assoc();
            echo "titolo: " . $row["titolo"]."<br>". " autore: " . $row["autore"]. "<br>"."anno di pubblicazione: " . $row["anno_pubblicazione"]."<br>". "genere: " . $row["genere"];

        }
        
}
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento</title>
    
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
                <li><a href="registrazione.php">Registrati</a></li>
        <li><a href="Prestito.php">Inserisci prestito o restituisci libro</a></li>
        <li><a href="ricerca.php">Cerca libro</a></li>

    
    <br><br>
    <h1>INSERIMENTO LIBRI</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <label for="titolo">Titolo: </label>
        <input type="text" name="titolo" id="titolo">
        <label for="autore">Autore: </label>
        <input type="text" name="autore" id="autore">
        <label for="anno_pubblicazione">Anno di pubblicazione: </label>
        <input type="number" name="anno_pubblicazione" id="anno_pubblicazione" min="1900" max="2024">
        <label for="genere">Genere: </label>
        <select name="genere" id="genere">
            <option value="narrativa">Narrativa</option>
            <option value="saggistica">Saggistica</option>
            <option value="fantascienza">Fantascienza</option>
            <option value="giallo">Giallo</option>
            <option value="storico">Storico</option>
            <option value="biografico">Biografico</option>
            <option value="Fantasy">Fantasy</option>
        </select>
        <input type="submit" name="invio" id="invio" value="inserisci libro">
    </form>
</body>
</html>
