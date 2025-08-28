<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $gender = $_POST['gender'];
    $branch = $_POST['branch'];
    $membership = $_POST['membership'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $allowed_memberships = ['starter', 'basic', 'standard', 'pro', 'premium', 'family', 'student', 'annual_elite'];

    if (in_array($membership, $allowed_memberships)) {

        $stmt = $conn->prepare("INSERT INTO membership (gender, branch, membership_type, first_name, last_name, email, contact) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $gender, $branch, $membership, $firstName, $lastName, $email, $contact);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Membership successfully added!');
                    window.location.href='user.html';
                  </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();

    } else {
        echo "Invalid membership selected!";
    }
}

$conn->close();
?>
