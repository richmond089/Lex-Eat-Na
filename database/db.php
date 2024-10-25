<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "lexeatnaaaa";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
