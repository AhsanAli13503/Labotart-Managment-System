<?php
// Fetching Values From URL
$name2 = $_POST['name1'];

$password2 = $_POST['password1'];
$contact2 = $_POST['user1'];

$conn = new mysqli("localhost","root","","labotary"); // Establishing Connection with Server..

$sql ="insert into user(username,password,job)values('$name2','$password2','$contact2')";
$result = $conn->query($sql);

if ($result) {
    echo "New User created successfully";
} else {
    echo "Error: " . $sql  . $conn->error;
}

$conn->close();

?>