<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 1-2-2016
 * Time: 10:38
 */

/**
 * Weergeeft de database
 */
?>
<table border="1">
    <tr>
        <td><b>Referentiecode</b></td>
        <td><b>Voornaam</b></td>
        <td><b>Achternaam</b></td>
        <td><b>E-mail</b></td>
        <td><b>Tijd aankoop</b></td>
        <td><b>Status betaling</b></td>
        <td><b>Prijs</b></td>
        <td><b>Aantal Kaarten</b></td>
    </tr>
<?php

require "../initialize.php";

global $servername, $username, $password, $dbname;
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = $conn->prepare("SELECT payment_id, firstname, lastname, email, unix_time, status, price FROM orders");

$sql->execute();
$sql->store_result();

if ($sql->num_rows == 0) {
    echo "Er zijn nog geen bestellingen. :( <br><br>";
    exit;
} else {
    $sql->bind_result($id, $voornaam, $achternaam, $email, $time, $status, $price);
    while($sql->fetch()) {
        $aantal = intval($price) / 10;
        echo "
        <tr>
            <td>{$id}</td>
            <td>{$voornaam}</td>
            <td>{$achternaam}</td>
            <td>{$email}</td>
            <td>{$time}</td>
            <td>{$status}</td>
            <td>&euro;{$price}</td>
            <td>{$aantal}</td>
        </tr>
        ";
    }
}

echo "</td></table>";

$conn->close();