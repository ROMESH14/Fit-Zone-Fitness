<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM membership ORDER BY first_name ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Membership Bookings</title>
    <link rel="stylesheet" href="admin_view_members.css">
</head>
<body>
    <h2>Registered Membership Details</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Branch</th>
                <th>Membership Type</th>
                <th>Email</th>
                <th>Contact</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                <td><?php echo htmlspecialchars($row['branch']); ?></td>
                <td><?php echo htmlspecialchars($row['membership_type']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['contact']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="no-data">No members have registered yet.</p>
    <?php endif; ?>

    <?php mysqli_close($conn); ?>
    <br>
    <a href="admin.html" class="back-btn">← Back to Admin Page</a>
</body>
</html>
