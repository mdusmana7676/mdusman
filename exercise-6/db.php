
<?php

$conn = new mysqli("localhost", "root", "", "department_db");

if ($conn->connect_error) {
    die("Database connection failed");
}

?>
