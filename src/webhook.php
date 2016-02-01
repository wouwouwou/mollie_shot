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
    $order_id = $payment->metadata->order_id;
    /*
     * Update the order in the database.
     */
    database_write($order_id, $payment->status);
}
catch (Mollie_API_Exception $e)
{
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}
/*
 * NOTE: This example uses a text file as a database. Please use a real database like MySQL in production code.
 */
function database_write ($order_id, $status)
{
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "UPDATE orders SET status='$status' WHERE order_id=$order_id";
    echo $sql;
    $result = $conn->query($sql);

    if ($result == false) {
        echo "Error when writing to database. Please try again.";
        exit;
    }

    $conn->close();
}