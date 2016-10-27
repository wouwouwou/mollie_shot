


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

$sql = $conn->prepare("SELECT payment_id, firstname, lastname, email, price FROM orders WHERE unix_time=? AND status=?");

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
    $sql->bind_result($id, $voornaam, $achternaam, $email, $price);
    $sql->fetch();
    $aantal = intval($price) / 10;
}

$to = $email;
$subject = "[SHOT] Toegangskaarten";

$message = "
<html>
<head>
<title>[SHOT] Toegangskaarten</title>
<meta charset='UTF-8'>
    <title>Lustrumconcert | Kaartverkoop</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
    <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</head>
<body>

<div class='container'>
    <div class='jumbotron'>
        <h2>Toegangskaarten Lustrumconcert</h2>
    </div>
    <div class='row'>
        <div class='col-md-1'></div>
        <div class='col-md-8'>
            <h3>Uw bestelling is voltooid!</h3>
            <h5>Hierbij ontvangt u de e-mail ter bevestiging van uw bestelling. In deze e-mail vindt u ook de referentiecode waarmee<br>
            u de toegangskaarten kan afhalen voor aanvang van het concert. Indien u vragen<br>
             heeft kunt u mailen naar <a href='mailto:kaartverkoop@shot.utwente.nl'>kaartverkoop@shot.utwente.nl</a></h5><br>
            <div class='col-sm-2'>
                <p style='font-weight: bold;'>Voornaam:<br> {$voornaam}</p>
                <p style='font-weight: bold;'>Achternaam:<br> {$achternaam}</p>
                <p style='font-weight: bold;'>E-mail:<br> {$email}</p>
                <p style='font-weight: bold;'>Aantal kaarten:<br> {$aantal}</p>
                <p style='font-weight: bold;'>Referentiecode:<br> {$id}</p>
                <img src='http://www.studentunion.utwente.nl/verenigingeninfo/fotos/shotlogo_final1.jpg' alt='SHOT Logo'
                 style='width: 400px;' class='img-responsive img-rounded'><br>
                <img src='https://scontent-ams3-1.xx.fbcdn.net/hphotos-xal1/v/t1.0-9/12524019_727132620719875_4573466835668056095_n.jpg?oh=bf34c1da84feaae697136192ded0b216&oe=57247F21'
                 alt='SOLO Logo' style='width: 400px;' class='img-responsive img-rounded'>
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