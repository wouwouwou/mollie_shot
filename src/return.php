<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 1-2-2016
 * Time: 10:36
 */

/**
 * De returnpagina die de klant te zien krijgt na betaling.
 */

$status = database_read($_GET["order_id"]);
/*
 * Determine the url parts to these example files.
 */
$protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
$hostname = $_SERVER['HTTP_HOST'];
$path     = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);
echo "<p>Your payment status is '" . htmlspecialchars($status) . "'.</p>";
echo "<p>";
echo '<a href="' . $protocol . '://' . $hostname . $path . '/01-new-payment.php">Retry example 1</a><br>';
echo '<a href="' . $protocol . '://' . $hostname . $path . '/04-ideal-payment.php">Retry example 4</a><br>';
echo "</p>";
/*
 * NOTE: This example uses a text file as a database. Please use a real database like MySQL in production code.
 */
function database_read ($order_id)
{
    $order_id = intval($order_id);
    $database = dirname(__FILE__) . "/orders/order-{$order_id}.txt";
    $status = @file_get_contents($database);
    return $status ? $status : "unknown order";
}