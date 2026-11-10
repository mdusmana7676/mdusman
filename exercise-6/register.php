
<?php

include "db.php";

$message = "";

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $department = $_POST['department'];

    $stmt = $conn->prepare("INSERT INTO students (name, email, password, department) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $department);

    if ($stmt->execute()) {
        $message = "Registration Successful!";
    } else {
        $message = "Email already exists or registration failed.";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">

    <h2>Student Registration</h2>

    <form method="POST">

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="password" name="password" placeholder="Password" required>

        <select name="department" required>
            <option value="">Select Department</option>
            <option value="MCA">MCA</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Information Technology">Information Technology</option>
        </select>

        <button type="submit" name="register">Register</button>

    </form>

    <p><?php echo htmlspecialchars($message); ?></p>

    <a href="login.php">Already Registered? Login</a>

</div>

</body>
</html>
