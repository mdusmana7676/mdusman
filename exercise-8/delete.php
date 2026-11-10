<?php
include "db.php";

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: index.php");
exit();
?>