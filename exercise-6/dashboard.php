
<?php

session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Student Dashboard</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['student_name']); ?>!</h2>
    <p>You have successfully logged in.</p>
    <p>Welcome to the Computer Science Department Portal.</p>
</section>

</body>
</html>
