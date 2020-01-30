<?php
// Create connection
$conn = new mysqli("localhost","root","","labotary");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
   
}
$name2 = $_POST['name1'];
$time = strtotime($name2);
 
$newformat = date('Y-m-d',$time);
$sql ="select GrandTotal from recepdetail where date = '$newformat' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $amount = 0 ;
    while($row = $result->fetch_assoc()) {
        $amount = $amount + $row['GrandTotal'];
    }
    echo "Sale On date: ".$amount;
} else {
    echo "No Sale Record On this Date";
}
$conn->close();
?>