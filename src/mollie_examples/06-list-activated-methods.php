<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 29-1-2016
 * Time: 15:25
 */

/*
 * Example 6 - How to get the currently activated payment methods.
 */
try
{
    /*
     * Initialize the Mollie API library with your API key.
     *
     * See: https://www.mollie.com/beheer/account/profielen/
     */
    include "../../initialize.php";

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

    $issuers = $mollie->issuers->all();
    foreach ($issuers as $issuer)
    {
        echo '<div style="line-height:40px; vertical-align:top">';
        echo htmlspecialchars($issuer->method) . '<br />';
        echo htmlspecialchars($issuer->id) . ' (' .  htmlspecialchars($issuer->name) . ')';
        echo '</div>';
    }
}
catch (Mollie_API_Exception $e)
{
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}