<?php

$conn = new mysqli("localhost", "root", "", "contact_management");

if ($conn->connect_error) {
    die("Database connection failed");
}

?>