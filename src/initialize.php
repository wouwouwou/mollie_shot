<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 29-1-2016
 * Time: 15:35
 */

require __DIR__ . '\..\vendor\autoload.php';

/*
 * Initialize the Mollie API library with your API key.
 *
 * See: https://www.mollie.com/beheer/account/profielen/
 */
$mollie = new Mollie_API_Client;

$mollie->setApiKey("test_knXSwBN55uqRwLNHeGH2nHGsYZDi7d");
//$mollie->setApiKey("live_XJdLA2wPvTFXzU67hxXrTVibTtn3tj");
