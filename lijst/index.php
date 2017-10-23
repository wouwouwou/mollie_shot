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
        <td><b>Betalingsreferentie</b></td>
        <td><b>Voornaam</b></td>
        <td><b>Achternaam</b></td>
        <td><b>E-mail</b></td>
        <td><b>Tijd aankoop</b></td>
        <td><b>Status betaling</b></td>
        <td><b>Aantal concertkaarten</b></td>
        <td><b>Aantal concertkaarten (student)</b></td>
        <td><b>Aantal NS-kaarten</b></td>
        <td><b>Prijs</b></td>
    </tr>
<?php

require "../initialize.php";

global $servername, $username, $password, $dbname;
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = $conn->prepare("SELECT payment_id, firstname, lastname, email, unix_time, status, tickets_concert, tickets_st, tickets_ns, total_price FROM orders GROUP BY unix_time");

$sql->execute();
$sql->store_result();

$total = 0;

if ($sql->num_rows == 0) {
    echo "Er zijn nog geen bestellingen. :( <br><br>";
    exit;
} else {
    $sql->bind_result($id, $voornaam, $achternaam, $email, $time, $status, $tickets_concert, $tickets_st, $tickets_ns, $price);
    while($sql->fetch()) {
        if ($status == "paid") {
            $total += $tickets_concert + $tickets_st;
        }
        $price = number_format($price, 2);
        $time = gmdate("d-m-Y H:i:s", $time);
        echo "
        <tr>
            <td>{$id}</td>
            <td>{$voornaam}</td>
            <td>{$achternaam}</td>
            <td>{$email}</td>
            <td>{$time}</td>
            <td>{$status}</td>
            <td>{$tickets_concert}</td>
            <td>{$tickets_st}</td>
            <td>{$tickets_ns}</td>
            <td>&euro;{$price}</td>
        </tr>
        ";
    }
}

echo "</td></table><br />";
echo "{$total}";
$conn->close();
