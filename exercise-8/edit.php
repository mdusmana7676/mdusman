<?php
include "db.php";

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$contact = $result->fetch_assoc();

if (!$contact) {
    die("Contact not found");
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE contacts SET name=?, email=?, phone=?, address=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating contact";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <h1>Edit Contact</h1>

    <form method="POST">
        <input type="text" name="name" value="<?php echo htmlspecialchars($contact['name']); ?>" required>
        <input type="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
        <textarea name="address"><?php echo htmlspecialchars($contact['address']); ?></textarea>

        <button type="submit" name="update">Update Contact</button>
    </form>

    <a href="index.php" class="back">Back to Contacts</a>
</div>

</body>
</html>