<?php
	$user=$_POST["username"];
	$pass=$_POST["pass"];

  
	  include 'databaseconnection.php';
    
    $sql ="select job from user where username = '$user' and password = '$pass'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
      session_start();
      
	    $row = $result->fetch_assoc();
      $job = $row["job"];
      $_SESSION["user"] = $user;
      $_SESSION["job"] = $job;
      if ($job == 'admin')
      {
        header("location:admin.php");
      }
      elseif ($job == 'recp') 
      {
        header("location:recep.php");
      }
      else
      {
        echo ("location:tech.php");
      }
      
    }
    else 
	  {
      
   		header("location:main.php");
	 }

?>