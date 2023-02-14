<?php
// echo $_GET['Id'];
// Voeg de verbindingsgegevens toe in config.php
require('config.php');

// Maak de data sourcename string
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
// 
try {
    $pdo =  new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "Er is een verbinding met de database";
    } else {
        echo "Interne server-error";
    }
} catch(PDOException $e) {
    echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // var_dump($_POST);
    // Maak een sql update-query en vuur deze af op de database

    try {
        $sql = "UPDATE achtbaan
            SET    Achtbaan = :achtbaan, 
                   Pretpark = :pretpark, 
                   Land = :land,
                   Topsnelheid = :snelheid,
                   Hoogte = :hoogte,
                   Opening = :datum,
                   Cijfer = :cijfer,
            WHERE  Id = :id";

    $statement = $pdo->prepare($sql);

    $statement->bindValue(':achtbaan', $_POST['coaster'], PDO::PARAM_STR);
    $statement->bindValue(':pretpark', $_POST['park'], PDO::PARAM_STR);
    $statement->bindValue(':land', $_POST['country'], PDO::PARAM_STR);
    $statement->bindValue(':snelheid', $_POST['speed'], PDO::PARAM_STR);
    $statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    $statement->bindValue(':hoogte', $_POST['height'], PDO::PARAM_STR);
    $statement->bindValue(':datum', $_POST['date'], PDO::PARAM_STR);
    $statement->bindValue(':cijfer', $_POST['number'], PDO::PARAM_int);

    $statement->execute();

    echo "Het updaten is gelukt";
    header('Refresh:1; url=read.php');
    } catch(PDOException $e) {
        echo "Het updaten is niet gelukt";
        header('Refresh:1; url=read.php');
    }
    

    // Stuur de gebruiker door naar de read.php pagina voor het overzicht met een header(Refresh) functie;
    exit();
}

// Maak een sql-query voor de database
$sql = "SELECT  Id
                ,Achtbaan
                ,Pretpark
                ,Land
                ,Topsnelheid
                ,Hoogte
                ,Opening
                ,Achtbaan)
        FROM achtbaan
        WHERE Id = :Id";

// Maak de sql-query klaar om de $_GET['Id'] waarde te koppelen aan de placeholder :Id
$statement = $pdo->prepare($sql);

// Koppel de waarde $_GET['Id'] aan de placeholder :Id
$statement->bindValue(':Id', $_GET['Id'], PDO::PARAM_INT);

// Voer de query uit
$statement->execute();

// Haal het resultaat op met fetch en stop het object in de variabele $result
$result = $statement->fetch(PDO::FETCH_OBJ);

// var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snelste achtbaan</title>
</head>
<body>
    <h1>Achtbaan</h1>
    
    <form action="update.php" method="post">

        <label for="coaster">Achtbaan:</label><br>
        <input type="text" name="coaster" id="coaster" value="<?= $result->Voornaam; ?>"><br>
        <br>
        <label for="park">Pretpark:</label><br>
        <input type="text" name="park" id="park" value="<?= $result->Tussenvoegsel; ?>"><br>
        <br>
        <label for="country">Land:</label><br>
        <input type="text" name="country" id="country" value="<?= $result->Achternaam; ?>"><br>
        <br>
        <label for="speed">Snelheid:</label><br>
        <input type="text" name="speed" id="speed" value="<?= $result->Haarkleur; ?>"><br>
        <br>
        <label for="height">Hoogte:</label><br>
        <input type="number" name="height" id="height" value="<?= $result->Haarkleur; ?>"><br>
        <br>
        <label for="date">Opening:</label><br>
        <input type="text" name="date" id="date" value="<?= $result->Haarkleur; ?>"><br>
        <br>
        <label for="number">Cijfer:</label><br>
        <input type="number" name="number" id="number" value="<?= $result->Haarkleur; ?>"><br>
        <br>
        
        <input type="hidden" name="id" value="<?= $result->Id; ?>">
        <br>

        <input type="submit" value="Verstuur!">        

    </form>
</body>
</html>