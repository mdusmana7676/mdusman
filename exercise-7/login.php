
<?php

session_start();
include "db.php";

$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if ($password == $user['password']) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "Incorrect Password";
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
    <title>Company Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">

    <h2>Company Login</h2>
    <p>Login to Your Account</p>

    <form method="POST">

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

    </form>

    <p class="message">
        <?php echo htmlspecialchars($message); ?>
    </p>

    <a href="index.php">Back to Home</a>

</div>

</body>
</html>
