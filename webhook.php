<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 1-2-2016
 * Time: 10:36
 */

/**
 * De webhook die aan wordt geroepen door Mollie om door te geven of een betaling gelukt is.
 */

try
{
    /*
     * Initialize the Mollie API library with your API key.
     *
     * See: https://www.mollie.com/beheer/account/profielen/
     */
    require "initialize.php";

    /*
     * Check if this is a test request by Mollie
     */
    if (!empty($_GET['testByMollie']))
    {
        die('OK');
    }

    /*
     * Retrieve the payment's current state.
     */
    $payment  = $mollie->payments->get($_POST["id"]);

    /*
     * Update the order in the database.
     */
    database_write($payment->id, $payment->status, intval($payment->metadata->time));
}
catch (Mollie_API_Exception $e)
{
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}
/*
 * NOTE: This example uses a text file as a database. Please use a real database like MySQL in production code.
 */
function database_write ($payment_id, $status, $time)
{
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare("UPDATE sales SET status=? WHERE payment_id=? AND unix_time=?");

    $sql->bind_param("ssi", $status, $payment_id, $time);

    $result = $sql->execute();

    if ($result == false) {
        echo "Error when writing to database. Please try again.";
        exit;
    }

    $conn->close();
}