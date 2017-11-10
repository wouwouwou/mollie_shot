<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 1-2-2016
 * Time: 09:03
 */

/**
 * Betaalpagina
 */

try
{
    //Initialize Mollie API and DB connection
    include "initialize.php";

    //Show form to customer
    if ($_SERVER["REQUEST_METHOD"] != "POST")
    {
        include "formulier.php";
        exit;
    }

    /*
     * Determine the url parts to these example files.
     
    $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
    $hostname = $_SERVER['HTTP_HOST'];
    $path     = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);
	*/

    $tickets_concert = intval($_POST["aantal_concert"]);
    $tickets_ns = intval($_POST["aantal_ns"]);
    $tickets_st = intval($_POST["aantal_st"]);
    $price = floatval($tickets_concert) * $normal_price + floatval($tickets_ns) * $ns_retour_price + floatval($tickets_st) * $student_price;

    $time = time();

    $method = $_POST["method"];
    switch ($method) {
        case "sofort":
            $method = Mollie_API_Object_Method::SOFORT;
            break;
        case "mistercash":
            $method = Mollie_API_Object_Method::MISTERCASH;
            break;
        default:
            $method = Mollie_API_Object_Method::IDEAL;
    }

    /*
     * Payment parameters:
     *   amount        Amount in EUROs.
     *   method        Payment method "ideal".
     *   description   Description of the payment.
     *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
     *   metadata      Custom metadata that is stored with the payment.
     *   issuer        The customer's bank. If empty the customer can select it later.
     */
    $payment = $mollie->payments->create(array(
        "amount"       => $price,
        "method"       => $method,
        "description"  => "Concert In SHOQ " . $time,
        //"redirectUrl"  => "http://localhost/mollie_shot/src/return.php?int={$time}",
        "redirectUrl"  => "http://www.shot.utwente.nl/kaartverkoop/return.php?int={$time}",
        //"webhookUrl"   => "http://{$ip}/mollie_shot/src/webhook.php",
        "webhookUrl"   => "http://www.shot.utwente.nl/kaartverkoop/webhook.php",
        "metadata"     => array(
            "time" => $time,
        ),
    ));

    /*
     * In this example we store the order with its payment status in a database.
     */
    database_write( $payment->id,
                    $_POST["firstname"],
                    $_POST["lastname"],
                    $_POST["e-mail"],
                    $time,
                    $payment->status,
                    $tickets_concert,
                    $tickets_st,
                    $tickets_ns,
                    $payment->amount);

    /*
     * Send the customer off to complete the payment.
     */
	//header("Location: http://shot.utwente.nl/kaartverkoop/return.php");
    header("Location: " . $payment->getPaymentUrl());
}
catch (Mollie_API_Exception $e)
{
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}

/*
 * Writes to the database with prepared statement
 */
function database_write ($payment_id, $firstname, $lastname, $e_mail, $time, $status, $tickets_concert, $tickets_st, $tickets_ns, $price)
{
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare("INSERT INTO orders (payment_id, firstname, lastname, email, unix_time, status, tickets_concert, tickets_st, tickets_ns, total_price)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $sql->bind_param("ssssisiiid",$payment_id, $firstname, $lastname, $e_mail, $time, $status, $tickets_concert, $tickets_st, $tickets_ns, $price);

    $result = $sql->execute();

    if ($result == false) {
        echo "Error when writing to database. Please try again.";
        exit;
    }

    $conn->close();
}