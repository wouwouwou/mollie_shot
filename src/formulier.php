<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SHOT-SOLO Concert | Kaartverkoop</title>
</head>
<body>
<h1>Bestelformulier Toegangskaarten SHOT-SOLO Concert</h1>
<h4>Voer hier uw gegevens in:</h4>
<form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">
    <label>Voornaam:</label><br>
    <input type="text" name="firstname"><br><br>
    <label>Achternaam:</label><br>
    <input type="text" name="lastname"><br><br>
    <label>E-mail:</label><br>
    <input type="text" name="e-mail"><br><br>
    <label>Aantal toegangskaarten:</label><br>
    <select name="aantal">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select><br><br>
    <input type="submit" value="Bestellen en betalen via iDeal">
</form>
</body>
</html>