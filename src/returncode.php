


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

$order_id = $_GET["order_id"];

/*
 * NOTE: This example uses a text file as a database. Please use a real database like MySQL in production code.
 */

global $servername, $username, $password, $dbname;
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM orders WHERE order_id=$order_id AND status='paid'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Error, 0 reports!";
    exit;
} else if ($result->num_rows > 1) {
    echo "Error, more than 1 result!";
    exit;
} else {
    $row = $result->fetch_row();
    $voornaam = $row[0];
    $achternaam = $row[1];
    $email = $row[2];
    $price = $row[5];
    $aantal = intval($price) / 10;
}

$conn->close();

$to = $email;
$subject = "[SHOT] Toegangskaarten";

$message = "
<html>
<head>
<title>[SHOT] Toegangskaarten</title>
<meta charset='UTF-8'>
    <title>SHOT-SOLO Concert | Kaartverkoop</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
    <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</head>
<body>

<div class='container'>
    <div class='jumbotron'>
        <h2>Toegangskaarten SHOT-SOLO Concert</h2>
    </div>
    <div class='row'>
        <div class='col-md-1'></div>
        <div class='col-md-8'>
            <h3>Uw bestelling is voltooid!</h3>
            <h5>Bij deze de e-mail ter bevestiging van uw gegevens. Hier vindt u ook de referentiecode waarmee<br>
            wij u snel de toegangskaarten kunnen verstrekken wanneer u aankomt bij het concert. Indien u vragen<br>
             heeft kunt u mailen naar <a href='mailto:kaartverkoop@shot.utwente.nl'>kaartverkoop@shot.utwente.nl</a></h5><br>
            <div class='col-sm-2'>
                <p style='font-weight: bold;'>Voornaam:<br> {$voornaam}</p>
                <p style='font-weight: bold;'>Achternaam:<br> {$achternaam}</p>
                <p style='font-weight: bold;'>E-mail:<br> {$email}</p>
                <p style='font-weight: bold;'>Aantal kaarten:<br> {$aantal}</p>
                <p style='font-weight: bold;'>Referentiecode:<br> {$order_id}</p>
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
$headers .= "From: <kaartverkoop@shot.utwente.nl>" . "\r\n";

mail($to,$subject,$message,$headers);