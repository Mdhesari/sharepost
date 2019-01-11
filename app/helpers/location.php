<?php

/* Get user's location using their ip by Geoplugin.com API */
function getLocation()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    return json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip=' . $ip));
}
