<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="shortcut icon" href="icon.png" />
	<title>Ali Diagnostics</title>

  <script type="text/javascript" src="recep.js"></script>
  <link rel="stylesheet" href="recep.css">
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

        @import url("https://bootswatch.com/flatly/bootstrap.min.css");

body {
  padding-top: 50px;
}
footer {
  padding-left: 15px;
  padding-right: 15px;
}

/*
 * Off Canvas
 * --------------------------------------------------
 */
@media screen and (max-width: 768px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all 0.25s ease-out;
    -moz-transition: all 0.25s ease-out;
    transition: all 0.25s ease-out;
    background:#ecf0f1;
  }

  .row-offcanvas-left
  .sidebar-offcanvas {
    left: -40%;
  }

  .row-offcanvas-left.active {
    left: 40%;
  }

  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 40%;
    margin-left: 12px;
  }
}

#sidebar {
    padding:15px;
    margin-top:10px;
}

#about{
    display: none;
}
#experience{
    display: none;
}
  </style>

</head>
<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href="#">Ali Diagnostics Center</a>
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
      <div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="sidebar-nav">
                <ul class="nav">

                    
                <li class="nav-item">
                        <a id = "abc1" class="nav-link js-scroll-trigger" href="#about">Add User</a>
                </li>
                <li class="nav-item">
                        <a id = "abc2" class="nav-link js-scroll-trigger" href="#experience">Check Account Detail</a>
                </li>
                    
                </ul>
            </div>
            <!--/.well -->
        </div>
        <!--/span-->

        <div class="col-xs-12 col-sm-9">
            <section style="text-align:center;" class="resume-section p-3 p-lg-5 d-flex align-items-center" id="about">
                <h3 >Create User</h3>
                <br>
                <form action="" >
                    <label>Name</label>
                    <input id = "name" type="text" name = "name"><br><br>
                    <label>Create Password</label>
                    <input id= "pass1" type="text" name = "pass"><br><br>
                    <label>User Types</label>
                    <select id = "user" name="user">
                        <option value="recp">Receptionist</option>
                        <option value="admin">Admin</option>
                        <option value="tech">Technician</option>
                        
                    </select><br><br>
                    <button onclick="callAjax()"> Create User</button>
                </form>
            </section>
            <section style= "text-align:center;"class="resume-section p-3 p-lg-5 d-flex align-items-center" id="experience">
                <form action="" >
                <label for="start">select date:</label>

                <input type="date" id="start" name="trip-start"
                    value="2018-07-22"
                        min="2019-01-01" max="2020-12-31">
                        <br><br>
                    <button onclick="callAjax2()">Get Amount</button>
                </form>
                <h1 id= "amount" >waiting...</h1>
            </section>
        </div>
</div>
<script>
document.getElementById("abc1").addEventListener("click", myFunction);
document.getElementById("abc2").addEventListener("click", myFunction2);
function myFunction() {
    var a = document.getElementById("experience");
    a.style.display = "none";
    var a = document.getElementById("about");
    a.style.display = "block";
}
function myFunction2() {
    var a = document.getElementById("experience");
    a.style.display = "block";
    var a = document.getElementById("about");
    a.style.display = "none";
}
function callAjax(){
    var name = document.getElementById("name").value;
    var password = document.getElementById("pass1").value;
    var user = document.getElementById("user").value;
    // Returns successful data submission message when the entered information is stored in database.
    var dataString = '&name1=' + name  + '&password1=' + password + '&user1=' + user;
    if (name == '' || password == '' || user == '') {
    alert("Please Fill All Fields");
    } else {
    // AJAX code to submit form.
    $.ajax({
    type: "POST",
    url: "ajaxjs.php",
    data: dataString,
    cache: false,
    success: function(html) {
    alert(html);
    }
    });
    }
    return false;
}
function callAjax2(){
    var name = document.getElementById("start").value;
    
    //Returns successful data submission message when the entered information is stored in database.
    var dataString = '&name1=' + name ;
    
    if (name == '' ) {
    alert("Please select Date");
    } else {
    // AJAX code to submit form.
    $.ajax({
    type: "POST",
    url: "ajaxjs2.php",
    data: dataString,
    cache: false,
    success: function(html) {
        document.getElementById("amount").innerHTML= html;
        
    }
    });
    }
    return false;
    
    
}
</script>
</body>