


<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 1-2-2016
 * Time: 10:36
 */

/**
 * De returnpagina die de klant te zien krijgt na betaling.
 */

require "initialize.php";

$time = $_GET["int"];

global $servername, $username, $password, $dbname;
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = $conn->prepare("SELECT payment_id, firstname, lastname, email, tickets_concert, tickets_ns FROM orders WHERE unix_time=? AND status=?");

$req_status = "paid";
$sql->bind_param("ss", $time, $req_status);

$sql->execute();
$sql->store_result();

if ($sql->num_rows == 0) {
    echo "Er ging helaas iets mis! Probeer het <a href='./'>hier</a> opnieuw of neem contact op met <a href='mailto:kaartverkoop@shot.utwente.nl'>kaartverkoop@shot.utwente.nl</a>";
    exit;
} else if ($sql->num_rows > 1) {
    echo "Er ging helaas iets mis! Probeer het <a href='./'>hier</a> opnieuw of neem contact op met <a href='mailto:kaartverkoop@shot.utwente.nl'>kaartverkoop@shot.utwente.nl</a>";
    exit;
} else {
    $sql->bind_result($id, $voornaam, $achternaam, $email, $tickets_concert, $tickets_ns);
    $sql->fetch();
}

$to = $email;
$subject = "[SHOT] Toegangskaarten Muziekale Roadtrip";

$message = "
<html>
<head>
<title>[SHOT] Muzikale Roadtrip</title>
<meta charset='UTF-8'>
    <title>Muzikale Roadtrip SHOT - QHarmony - De Ontzetting | Kaartverkoop</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
    <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</head>
<body>

<div class='container'>
    <div class='jumbotron'>
        <h2>Toegangskaarten Muzikale Roadtrip</h2>
    </div>
    <div class='row'>
        <div class='col-md-1'></div>
        <div class='col-md-8'>
            <h3>Uw bestelling is voltooid!</h3>
            <h5>Hierbij ontvangt u de e-mail ter bevestiging van uw bestelling. U kunt uw toegangskaarten afhalen voor aanvang<br>
            van het concert en staan op uw naam. Indien u vragen heeft kunt u mailen naar <a href='mailto:kaartverkoop@shot.utwente.nl'>kaartverkoop@shot.utwente.nl</a>
            <br><br>
            Uw bestelgegevens:</h5><br>
            <div class='col-sm-2'>
                <p style='font-weight: bold;'>Voornaam:<br> {$voornaam}</p>
                <p style='font-weight: bold;'>Achternaam:<br> {$achternaam}</p>
                <p style='font-weight: bold;'>E-mail:<br> {$email}</p>
                <p style='font-weight: bold;'>Aantal toeganskaarten:<br> {$tickets_concert}</p>
                <p style='font-weight: bold;'>Aantal NS-groepskaarten:<br> {$tickets_ns}</p>
                <img src=\"http://www.studentunion.utwente.nl/verenigingeninfo/fotos/shotlogo_final1.jpg\" alt=\"SHOT Logo\"
                 style=\"width: 200px;\" class=\"img-responsive img-rounded\">
            <img src=\"https://upload.wikimedia.org/wikipedia/commons/e/e4/QHarmony_Nijmegen.png\" alt=\"QHarmony Logo\"
                 style=\"width: 200px;\" class=\"img-responsive img-rounded\">
            <img src=\"https://pbs.twimg.com/profile_images/2223593721/Sticker_button_Ontzetting_2008.jpg\" alt=\"Ontzetting Logo\"
                 style=\"width: 200px;\" class=\"img-responsive img-rounded\">
            </div>
        </div>
    </div>
</div>

</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From: SHOT Kaartverkoop <kaartverkoop@shot.utwente.nl>" . "\r\n";

mail($to,$subject,$message,$headers);

$conn->close();