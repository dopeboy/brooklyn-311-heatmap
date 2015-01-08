<?php

if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "clownfish.io")
{
    $dbname = "311_staging_db";
    $demo = true;
    $dbuser = "311stageuser";
    $dbpass = 'dumbo';
}

?>
