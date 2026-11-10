
<?php

session_start();
include "db.php";

$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['student_id'] = $user['id'];
            $_SESSION['student_name'] = $user['name'];

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "Invalid Password";
        }

    } else {
        $message = "User Not Found";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">

    <h2>Student Login</h2>

    <form method="POST">

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

    </form>

    <p><?php echo htmlspecialchars($message); ?></p>

    <a href="register.php">Create New Account</a>

</div>

</body>
</html>
