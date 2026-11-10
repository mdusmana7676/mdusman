
<?php

include "db.php";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];

    $stmt = $conn->prepare("INSERT INTO employees (name, email, phone, department, salary) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssd", $name, $email, $phone, $department, $salary);

    if ($stmt->execute()) {
        echo "<h2>Employee Details Added Successfully!</h2>";
        echo "<a href='index.php'>Add Another Employee</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>
