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

global $concert_title,
       $normal_price,
       $student_price,
       $ns_retour_price,
       $concert_title,
       $ns_retour_possible,
       $concert_date,
       $concert_time;

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = $conn->prepare("SELECT payment_id, firstname, lastname, email, tickets_concert, tickets_st, tickets_ns FROM sales WHERE unix_time=? AND status=?");

$req_status = "paid";
$sql->bind_param("ss", $time, $req_status);

$sql->execute();
$sql->store_result();

if ($sql->num_rows == 0 || $sql->num_rows > 1) {
    echo "Er ging helaas iets mis! Probeer het <a href='./'>hier</a> opnieuw of neem contact op met <a href='mailto:kaartverkoop@shot.utwente.nl'>kaartverkoop@shot.utwente.nl</a>";
    exit;
} else {
    $sql->bind_result($id, $voornaam, $achternaam, $email, $tickets_concert, $tickets_st, $tickets_ns);
    $sql->fetch();
}

$to = $email;
$subject = "[SHOT] Toegangskaarten Maestroconcert";

$message = "
<html>
<head>
<title>[SHOT] SHOT Travels Through Time</title>
<meta charset='UTF-8'>
    <title>SHOT Travels Through Time | Kaartverkoop</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
    <link href=\"https://shot.utwente.nl/templates/shaper_helix3/images/favicon.ico\" rel=\"shortcut icon\" type=\"image/vnd.microsoft.icon\" />
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</head>
<body>

<div class='container'>
    <div class='page-header'>
        <h2>Toegangskaarten SHOT Travels Through Time</h2>
    </div>
    <div class='row'>
        <div class='col-md-1'></div>
        <div class='col-md-8'>
            <h3>Uw bestelling is voltooid!</h3>
            <h5>";

if($ns_retour_possible) {
    $message .= "De toegangskaarten kunt u voor aanvang van het concert afhalen op de concertlocatie en staan op uw naam.
                De NS Groupretours worden op een later moment verwerkt en uiterlijk één week voor het concert per e-mail
                naar u toegezonden.<br><br>";
} else {
    $message .= "De toegangskaarten kunt u voor aanvang van het concert afhalen op de concertlocatie en staan op uw naam. <br><br>";
}

$message .=  "Indien u nog vragen heeft, neem dan contact met ons op via
				<a href='mailto:kaartverkoop@shot.utwente.nl'>kaartverkoop@shot.utwente.nl</a> of kijk op
				<a href='https://www.shot.utwente.nl' target=\"_blank\">www.shot.utwente.nl</a>
			</h5>
            <br>
            Uw bestelgegevens:</h5>
            <div class='col-sm-2'>
                <p style='font-weight: bold;'>Voornaam:<br> {$voornaam}</p>
                <p style='font-weight: bold;'>Achternaam:<br> {$achternaam}</p>
                <p style='font-weight: bold;'>E-mail:<br> {$email}</p>
                <p style='font-weight: bold;'>Aantal toegangskaarten:<br> {$tickets_concert}</p>
                <p style='font-weight: bold;'>Aantal toegangskaarten (student):<br> {$tickets_st}</p>";

if($ns_retour_possible) {
    $message .= "<p style='font-weight: bold;'>Aantal NS-groepskaarten:<br> {$tickets_ns}</p>";
}

$message .= "   <img src=\"https://shot.utwente.nl/images/logos/1920px-SHOT_logo.png\" alt=\"SHOT Logo\"
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