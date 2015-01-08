<?php

$dbhost = "127.0.0.1";
$domain = "http://" . $_SERVER['SERVER_NAME'];

$app_name = "311 Heatmap";
$default_controller = "keys";
$default_action = "create";

function getRandomID()
{
	return rand(100000,999999);
}

function startsWith($haystack, $needle)
{
	return !strncmp($haystack, $needle, strlen($needle));
}

?>
