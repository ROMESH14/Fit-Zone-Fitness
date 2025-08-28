<?php
$firstName =$_POST['firstname'];
$lastname =$_POST['lastname'];
$age =$_POST['age'];
$wight =$_POST['wight'];
$gender =$_POST['gender'];
$email =$_POST['email'];
$contact =$_POST['contact'];

$conn = new mysqli('localhost','root','','mydb');
if($conn->connect_error){
    die('connection Faild :'.$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into registration(firstname,lastname,age,wight,gender,email,contact)
    value(?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssi",$firstName,$lastname,$age,$wight,$gender,$email,$contact);
    $stmt->execute();
    echo "<script>
    alert(' Your registration was successful.');
    window.location.href='signup.html';
</script>";
    $stmt->close();
    $conn->close();
}
?>