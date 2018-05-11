<?php

/**
 * Configuration for database connection
 *
 */

$host       = "localhost";
$username   = "root";
$password   = "zunliang";
$dbname     = "test"; // will use later
$dsn        = "mysql:host=127.0.0.1;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                 );