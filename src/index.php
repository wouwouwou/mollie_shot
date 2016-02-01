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
    /*
     * Initialize the Mollie API library with your API key.
     *
     * See: https://www.mollie.com/beheer/account/profielen/
     */
    include "initialize.php";

    /*
     * First, let the customer fill in the order
     */
    if ($_SERVER["REQUEST_METHOD"] != "POST")
    {
        echo '<form method="post">Hier komt een formulier! <button>OK</button></form>';
        exit;
    }

    /*
     * Generate a unique order id for this example. It is important to include this unique attribute
     * in the redirectUrl (below) so a proper return page can be shown to the customer.
     */
    $order_id = time();
    /*
     * Determine the url parts to these example files.
     */
    $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
    $hostname = $_SERVER['HTTP_HOST'];
    $path     = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);
    /*
     * Payment parameters:
     *   amount        Amount in EUROs. This example creates a € 0.01 payment.
     *   method        Payment method "ideal".
     *   description   Description of the payment.
     *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
     *   metadata      Custom metadata that is stored with the payment.
     *   issuer        The customer's bank. If empty the customer can select it later.
     */
    $payment = $mollie->payments->create(array(
        "amount"       => $_POST["price"],
        "method"       => Mollie_API_Object_Method::IDEAL,
        "description"  => "SHOT-SOLO concert " . $order_id,
        "redirectUrl"  => "{$protocol}://{$hostname}{$path}/return.php?order_id={$order_id}",
        "webhookUrl"   => "http://130.89.143.186/mollie_shot/src/mollie_examples/webhook.php",
        "metadata"     => array(
            "order_id" => $order_id,
        ),
    ));
    /*
     * In this example we store the order with its payment status in a database.
     */
    database_write($_POST["firstname"], $_POST["lastname"], $_POST["e-mail"], $order_id, $payment->status, $payment->amount);
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
 * NOTE: This example uses a text file as a database. Please use a real database like MySQL in production code.
 */
function database_write ($firstname, $lastname, $e_mail, $order_id, $status, $price)
{

    $order_id = intval($order_id);
    $database = dirname(__FILE__) . "/orders/order-{$order_id}.txt";
    file_put_contents($database, $status);
}
/*
 * database inloggegevens
 * gebruikersnaam: shot
 * ww: ronny
 */