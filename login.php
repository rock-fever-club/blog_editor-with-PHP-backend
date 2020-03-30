<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM admin WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> SAE LOGIN </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <style type="text/css">

body{
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background: url("login_bg.jpg") no-repeat center center fixed;
  background-size: cover ;
}
.login-box{
  width: 300px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  color:black;
  padding: 40px;
  background-color:rgba(0, 0, 0, 0.8);
}
.login-box h1{
  float: left;
  font-size: 40px;
  border-bottom: 6px solid #4caf50;
  margin-bottom: 50px;
  padding: 13px 0px;
  color:white;
}
.textbox{
  width: 100%;
  overflow: hidden;
  font-size: 20px;
  padding: 8px 0;
  margin-bottom:30px;
  border-bottom: 1px solid #4caf50;
}
.textbox i{
  width: 26px;
  float: left;
  text-align: center;
  color:white;
}

.textbox input{
  border: none;
  outline: none;
  background: none;
  color: white;
  font-size: 20px;
  width: 80%;
  float: left;
  margin: 0 10px;
}
.btn{
  width: 100%;
  background: none;
  border: 2px solid #4caf50;
  color: white;
  padding: 5px;
  font-size: 24px;
  cursor: pointer;
  margin: 12px 0;
  height:60px;
}

.btn:hover{
  background-color:#4caf50;
  color:white;
	}
@media only screen and (max-width: 550px) {
	.login-box{
	  width: 250px;
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%,-50%);
	  color:black;
	  padding: 40px;
	  background-color:rgba(0, 0, 0, 0.8);
	}
}
  </style>


  <body>
<div class="login-box">
  <h1>Login</h1>
  <form method="post" action="">
  <div class="textbox">
    <i class="fa fa-user"></i>
    <input type="username" name="username" placeholder="Username">
  </div>

  <div class="textbox">
    <i class="fa fa-lock"></i>
    <input type="password" name="password" placeholder="Password">
  </div>

  <input type="submit" class="btn" value="Sign in">
</form>
 <div style = "font-size:15px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

</div>
  </body>
</html>


