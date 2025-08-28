<?php
$Name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$conn = new mysqli('localhost', 'root', '', 'mydb');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $Name, $email, $message);
    $stmt->execute();
    echo "<script>
    alert('Your message was sent successfully.');
    window.location.href='home.html';
    </script>";
    $stmt->close();
    $conn->close();
}
?>
