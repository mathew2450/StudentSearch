<?php
/**
 * Configuration for database connection
 *
 */
$host       = "207.223.170.230";
$username   = "Test";
$password   = "Test";
$dbname     = "test";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );