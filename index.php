
<!DOCTYPE html>
<html>
<head>
    <title>Employee Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Employee Details</h1>
    <p>Enter Employee Information</p>

    <form action="insert.php" method="POST">

        <label>Employee Name</label>
        <input type="text" name="name" placeholder="Enter your name" required>

        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Phone Number</label>
        <input type="text" name="phone" placeholder="Enter phone number" required>

        <label>Department</label>
        <select name="department" required>
            <option value="">Select Department</option>
            <option value="HR">HR</option>
            <option value="IT">IT</option>
            <option value="Finance">Finance</option>
            <option value="Marketing">Marketing</option>
        </select>

        <label>Salary</label>
        <input type="number" name="salary" placeholder="Enter salary" step="0.01" required>

        <button type="submit" name="submit">Add Employee</button>

    </form>

</div>

</body>
</html>
