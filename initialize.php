<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 29-1-2016
 * Time: 15:35
 */

/**
 * Initializeren van Mollie Module d.m.v. composer
 * Initialize DB connection
 */

require __DIR__ . '/vendor/autoload.php';

/*
 * Initialize the Mollie API library with your API key.
 *
 * See: https://www.mollie.com/beheer/account/profielen/
 */
$mollie = new Mollie_API_Client;

// Select the test-api key or the live-api key
//$mollie->setApiKey("test_knXSwBN55uqRwLNHeGH2nHGsYZDi7d");
$mollie->setApiKey("live_XJdLA2wPvTFXzU67hxXrTVibTtn3tj");

//DB settings
$servername = "localhost";
$username = "wesp_192_rw";
$password = "klaasrulez";
$dbname = "wesp_shot_Website";

//Temporary IP
$ip = "130.89.141.209";