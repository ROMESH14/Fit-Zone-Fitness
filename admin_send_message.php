<?php

$conn = mysqli_connect("localhost", "root", "", "mydb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT CONCAT(firstname, ' ', lastname) AS name, email FROM registration";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Message to Members</title>
    <link rel="stylesheet" type="text/css" href="admin_send_message.css">
</head>
<body>
    <div class="container">
        <h2>Send Message to a Member</h2>
        <form action="send_message_process.php" method="POST">
            <label for="email">Select Member:</label>
            <select name="email" required>
                <option value="">-- Select --</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['email']}'>{$row['name']} ({$row['email']})</option>";
                }
                ?>
            </select>

            <label for="message">Message:</label>
            <textarea name="message" rows="5" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>
    <a href="admin.html" class="back-btn">← Back to Admin Page</a>
</body>
</html>

<?php mysqli_close($conn); ?>
