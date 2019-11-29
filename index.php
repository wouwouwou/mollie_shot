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
    $tickets_st = intval($_POST["aantal_st"]);
    $discount = 0;
    if ($student_group_discount_available && $tickets_st >= $student_group_discount_from_amount_of_students) {
        $discount = floatval($tickets_st * $student_group_discount);
    }
    $price = floatval($tickets_concert) * $normal_price +
        floatval($tickets_st) * $student_price -
        $discount;

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
        "description"  => "SHOT Travels Through Time | SHOT " . $time,
        "redirectUrl"  => "https://www.shot.utwente.nl/sales/return.php?int={$time}",
        "webhookUrl"   => "https://www.shot.utwente.nl/sales/webhook.php",
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
                    $discount,
                    $payment->amount);

    /*
     * Send the customer off to complete the payment.
     */
    header("Location: " . $payment->getPaymentUrl());
}
catch (Mollie_API_Exception $e)
{
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}

/*
 * Writes to the database with prepared statement
 */
function database_write ($payment_id, $firstname, $lastname, $e_mail, $time, $status, $tickets_concert, $tickets_st, $discount, $price)
{
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $firstname = htmlspecialchars($firstname);
    $lastname = htmlspecialchars($lastname);
    $e_mail = htmlspecialchars($e_mail);

    $sql = $conn->prepare("INSERT INTO sales (payment_id, firstname, lastname, email, unix_time, status, tickets_concert, tickets_st, discount, total_price)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $sql->bind_param("ssssisiiidd",$payment_id, $firstname, $lastname, $e_mail, $time, $status, $tickets_concert, $tickets_st, $discount, $price);

    $result = $sql->execute();

    if ($result == false) {
        echo "Error when writing to database. Please try again.";
        exit;
    }

    $conn->close();
}