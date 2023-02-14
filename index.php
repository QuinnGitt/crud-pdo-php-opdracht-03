

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>De 5 snelste achtbanen van Europa</h1>

    <form action="create.php" method="post">

        <label for="coaster">Naam Achtbaan:</label><br>
        <input type="text" name="coaster" id="coaster"><br>
        <br>
        <label for="park">Naam pretpark:</label><br>
        <input type="text" name="park" id="park"><br>
        <br>
        <label for="country">Naam Land:</label><br>
        <input type="text" name="country" id="country"><br>
        <br>
        <label for="speed">Topsnelheid (km/u):</label><br>
        <input type="number" name="speed" id="speed">
        <br>
        <br>
        <label for="height">Hoogte (m):</label><br>
        <input type="number" name="height" id="height">
        <br>
        <br>
        <label for="date">Datum eerste opening:</label><br>
        <input type="date" name="date" id="date">
        <br>
        <label for="number">Cijfer voor achtbaan:</label><br>
        <input type="range" name="number" id="number">
        <br>
        <input type="submit" value="Verstuur!">  
    </form>

</body>
</html>
