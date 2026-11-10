
<?php

$conn = new mysqli("localhost", "root", "", "company_db");

if ($conn->connect_error) {
    die("Database connection failed");
}

?>
