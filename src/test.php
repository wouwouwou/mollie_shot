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