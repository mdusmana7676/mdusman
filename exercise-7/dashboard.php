
<?php

session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];

if ($role == "admin") {

    $result = $conn->query("SELECT id, name, email, role FROM users WHERE role = 'employee'");

} else {

    $result = $conn->query("SELECT id, name, email, role FROM users WHERE role = 'admin'");

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Company Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>ABC Technologies</h1>
    <nav>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="dashboard">

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>

    <h3>
        <?php
        echo $role == "admin" ? "Employee Details" : "Admin Details";
        ?>
    </h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo ucfirst($row['role']); ?></td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
