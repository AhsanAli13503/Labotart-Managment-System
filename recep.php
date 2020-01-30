<?php
//index.php

$connect = new PDO("mysql:host=localhost;dbname=labotary", "root", "");
function fill_unit_select_box($connect)
{ 
 $output = '';
 $query = "SELECT * FROM test ORDER BY name ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["name"].'">'.$row["name"].'</option>';
 }
 return $output;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="shortcut icon" href="icon.png" />
	<title>Ali Diagnostics</title>
    <link rel="stylesheet" href="recep.css">
    <script type="text/javascript" src="recep.js"></script>
	 <script src="query.js"></script>
	
	<style type="text/css">
		
        #date_time
        {
            margin:15px;
            color:Navy;
            float:right;
        }
        #left
        {
            margin: 20px;
            float:right;
            padding: 20px;
        }
        #myBtn
        {
            
            float:right;
            display:inline;
        }
        #noDisplay
        {
            display: none;
        }
	</style>
    

</head>
<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href="recep.html">Ali Diagnostics Center</a>
		<div id="date_time"></div>
        <script type="text/javascript">window.onload = date_time('date_time');</script>
        <div id="abc">
            <img src="user.png" height=30px>
            <b><?php
             session_start();
             $user = $_SESSION["user"];
             echo $user; 
            ?></b>
        </div>
        <button id="btn" type="button" class="btn btn-info" onclick="window.location.href = 'main.php';">Logout</button>
  	</nav>
    
    <div id="majid">
        <form method="POST" action="insert.php" onsubmit="return validateForm()"  id="insert_form">
               <h4 class="hamza"> <b>Patient Details</b></h4>
                
                <pre> Name                     Gender      Age                     ReferedBy  </pre> 
                
                    
                <input class="spac" type="text" name="pat" placeholder="Name">&nbsp;&nbsp;&nbsp;
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>&nbsp;&nbsp;&nbsp;
                <input type="number" name="age">&nbsp;&nbsp;&nbsp;
                <select name="refer">
                    <option value="self">self</option>
                    <option value="doctor">doctor</option>
                    <option value="outlab">outlab</option>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <h4 class="hamza"><b>Test And Bill</b></h4>
                <table class="table table-bordered" id="item_table">
                    <tr>
                        <th>Test Name</th>
                        <th>price</th>
                        <th>Duration</th>
                        <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
                        <th><button id="getTotal" type="button">Get Total</button></th>
                    </tr>
                  </table>
                  <div  align="right" id="amount">
                  <p><strong>Discount %</strong></p>&nbsp;&nbsp;&nbsp;  <input  id ="dis" type="number" name="discount" value="0">
                    <strong><p id="amountpara">Total Amount = 0</p></strong>
                    <strong><p id="grand">GrandTotal = 0</p></strong>
                    <input id="hid" name="hiddens" type="hidden" >
                    <input id="hid" name="hiddens2" type="hidden" value="<?php echo $user?>" >
                </div>
                  <div align="right">
                     
                     <input type="submit" name="submit" class="btn btn-info" value="print and request">
                  </div>
                
        </form>
    </div>
    <div class="footer-copyright text-center py-3"><b>© Programmed By</b>
            <a href="https://www.facebook.com/profile.php?id=100005454153203"> Ahsan Ali</a>
        </div>      
  
 </body>
</html>
<script>
var i =1;
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><select id = "test'+i+'" name="testname'+i+'"class="form-control item_unit" onchange="myFunction()"><option value="">Select Test Name</option><?php echo fill_unit_select_box($connect); ?></select></td>';
  html += '<td><input id = "price'+i+'" type="text" name="price'+i+'" class="form-control item_name" /></td>';
  html += '<td><input id = "duration'+i+'" type="text" name="duration'+i+'" class="form-control item_quantity" /></td>';
  
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
  i=i+1;
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
  i=i-1;
 });
});
function myFunction() {
    num = i-1;
    var chhh= "testname"+num;
    var str = document.forms["insert_form"][chhh].value;
    getPrice(str);

}

$(document).on('click', '#getTotal', function(){
   var totalAmount=0;

   
   for (var j = i-1; j > 0; j--) {
      var ids = "price"+j;
      var price = Number(document.getElementById(ids).value);
      totalAmount+=price;
   }
   document.getElementById("amountpara").innerHTML = "Total Amount ="+totalAmount;
   var discount = Number(document.getElementById("dis").value);
   var disprice = totalAmount * discount / 100 ;
   var GrandTotal  = totalAmount - disprice;
   document.getElementById("grand").innerHTML = " Grand Total ="+GrandTotal;
 });

function getPrice(str) {
  var xhttp;    
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      var pos = data.search(" ");
      var data1 = data.slice(0,pos);
      var data2 = data.slice(pos+1);
      num = i-1;
      var name2 = "price"+num;
      var name1 = "duration"+num;
      var new1 = document.getElementById(name1);
      var new2 = document.getElementById(name2);
      new1.value =data1;
      new2.value = data2;
      document.getElementById('hid').value=i;

    }
  };
  xhttp.open("GET", "getpriceduration.php?q="+str, true);
  xhttp.send();
}

function validateForm(){
   var name = document.forms["insert_form"]["pat"].value;
   var gender  = document.forms["insert_form"]["gender"].value;
   var age = document.forms["insert_form"]["age"].value;
   var refer = document.forms["insert_form"]["refer"].value;
   var numOfTest = i-1;
   var testName = [numOfTest];
   var increment = 0;
   for (var j = i-1; j > 0; j--) {
      var ids = "test"+j;
      var testNames = document.getElementById(ids).value;
      testName[increment]=testNames;
      increment = increment +1;
   }
   var checker = 0 ;
   for (var k = 0 ; k < testName.length ; k++){
   if(testName[k]!="")
        checker+=1;
   }
   if ( name != "" && gender!="" && age>0 && refer!="" && i!=1)
   {
      checker+=10;
   }
   if (checker === 10 + numOfTest)
   {
    document.location.reload(true);
    return true
   }
   else{
    alert('All fields Must Be Filled');
    return false;
   }
   alert('All fields Must Be Filled');
   return false;
}
</script>
