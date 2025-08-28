<?php

@include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pws = md5($_POST['password']);     
    $Cpws = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM login WHERE email = '$email' AND password = '$pws'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error = "User already exists!";
    } else {
        if ($pws != $Cpws) {
            $error = "Passwords do not match!";
        } else {
            $insert = "INSERT INTO login (email, password, user_type) VALUES ('$email', '$pws', '$user_type')";
            if (mysqli_query($conn, $insert)) {
                header('Location:home.html');
                exit();
            } else {
                $error = "Error: " . mysqli_error($conn);
                
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>

<form action="signup.php" method="post">
    <?php if (isset($error)) : ?>
        <div style="color: red; margin-bottom: 15px; text-align: center;"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="container">
        <h1>Sign Up</h1>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label for="cpassword"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="cpassword" required>

        <label for="user_type"><b>User Type</b></label>
        <select name="user_type" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <br><br>

        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
            <button type="submit" name="submit" class="signupbtn">Sign Up</button>
            <button type="button" class="cancelbtn" onclick="window.location.href='home.html'">Cancel</button>
        </div>
    </div>
</form>
</body>
</html>
