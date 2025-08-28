<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$messageOutput = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO admin_messages (email, message) VALUES ('$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        $messageOutput = "<h3 class='success'>Message successfully sent to $email</h3>
                          <p>Message:</p>
                          <div class='message-box'>$message</div>";
    } else {
        $messageOutput = "<h3 class='error'>Error sending message: " . mysqli_error($conn) . "</h3>";
    }
} else {
    $messageOutput = "<h3 class='error'>Invalid Request.</h3>";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Message Sent</title>
    <link rel="stylesheet" type="text/css" href="send_message_process.css">
</head>
<body>
    <div class="message-container">
        <?= $messageOutput ?>
        <a href="admin_send_message.php" class="back-btn">Back</a>
    </div>
</body>
</html>
