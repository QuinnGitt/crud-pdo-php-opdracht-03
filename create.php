<?php
/**
 * We gaan contact maken met de mysql server
 */
require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    if ($pdo) {
        // echo "Er is een verbinding met de mysql-server";
    } else {
        echo "Er is een interne server-error, neem contact op met de beheerder";
    }

} catch(PDOException $e) {
    echo $e->getMessage();
}
// var_dump($_POST);
/**
 * We gaan een insert-query maken voor het wegschrijven van de formuliergegevens
 */
$sql = "INSERT INTO achtbaan (Id
                            ,Naam achtbaan
                            ,Naam Pretpark
                            ,Naam Land
                            ,Topsnelheid
                            ,Hoogte
                            ,Datum eertse Opening
                            ,Cijfer voor de achtbaan)
        VALUES              (NULL
                            ,:achtbaan
                            ,:pretpark
                            ,:land
                            ,:snelheid
                            ,:hoogte
                            ,:datum
                            ,:cijfer);";

// We bereiden de sql-query voor met de method prepare
$statement = $pdo->prepare($sql);

$statement->bindValue(':achtbaan', $_POST['coaster'], PDO::PARAM_STR);
$statement->bindValue(':pretpark', $_POST['park'], PDO::PARAM_STR);
$statement->bindValue(':land', $_POST['country'], PDO::PARAM_STR);
$statement->bindValue(':snelheid', $_POST['speed'], PDO::PARAM_INT);
$statement->bindValue(':hoogte', $_POST['height'], PDO::PARAM_INT);
$statement->bindValue(':datum', $_POST['date'], PDO::PARAM_INT);
$statement->bindValue(':cijfer', $_POST['number'], PDO::PARAM_INT);

// We vuren de sql-query af op de database

$result = $statement->execute();

if ($result) {
    echo "Er is een nieuw record gemaakt in de database.";
    header('Refresh:2; url=read.php');
} else {
    echo "Er is geen nieuw record gemaakt.";
    header('Refresh:2; url=read.php');
}
 