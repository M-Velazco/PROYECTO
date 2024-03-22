<?php
$hostname = "localhost";
$username = "root";
$password = "sena";
$dbname = "digiworm_04";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
  echo "Database connection error" . mysqli_connect_error();
}
