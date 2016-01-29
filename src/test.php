<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 29-1-2016
 * Time: 15:06
 */

//create mollie api client
$mollie = new Mollie_API_Client();

//insert api key
$mollie->setApiKey("test_knXSwBN55uqRwLNHeGH2nHGsYZDi7d");

//creates a new payment and adds it to the list of payments
$payment = $mollie->payments->create(array(
    "amount"        => 0.01,
    "description"   => "My first API payment",
    "redirectUrl"   => "http://google.nl"
));

//refresh the payment we just made
$payment = $mollie->payments->get($payment->id);

//if payment is paid, then echo something.
if($payment->isPaid()) {
    echo "Payment received!";
}

//get a list if issuers (banks which support iDeal). This is a list of Mollie_API_Object_Issuer objects
$issuers = $mollie->issuers->all();

/*
 * The Mollie_API_Object_Issuer object has an id, a name
 */

//Create an iDeal Payment
$ideal_payment = $mollie->payments->create(array(
    "amount"      => 0.01,
    "description" => "My first API payment with iDeal",
    "redirectUrl" => "http://nos.nl",
    "method" => Mollie_API_Object_Method::IDEAL,
    "issuer" => $selected_issuer_id, // e.g. "ideal_INGBNL2A"
));

/*
 * Example 6 - How to get the currently activated payment methods.
 */
try
{
    /*
     * Get all the activated methods for this API key.
     */
    $methods = $mollie->methods->all();
    foreach ($methods as $method)
    {
        echo '<div style="line-height:40px; vertical-align:top">';
        echo '<img src="' . htmlspecialchars($method->image->normal) . '"> ';
        echo htmlspecialchars($method->description) . ' (' .  htmlspecialchars($method->id) . ')';
        echo '</div>';
    }
}
catch (Mollie_API_Exception $e)
{
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}