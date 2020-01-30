<?php
 include 'databaseconnection.php';
 $q = $_REQUEST["q"];
 //$q = "test1";
 $sql ="select * from test where name = '$q'";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 $data1= strval($row["duration"]);
 $data2 = strval($row["price"]);
 
 /*$str = "";
 $str+=$data2;
 $str+= "   ";
 $str+=$data1;
 echo $str;*/
 $str =$data1 ." ".$data2;
 echo($str);
?>

