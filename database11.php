<?php
   include 'databaseconnection.php';
   
   $name = $_POST['testName'];
   $duration = $_POST['duration'];
   $price = $_POST['price'];

	require ('databaseconnection.php');
    $sql ="insert into test(name,price,duration)values('$name','$price','$duration')";
    $result = $conn->query($sql);
    echo $result;
?>