<?php
session_start();
$_SESSION["login"]=false;
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Open Elective Recommendation System</title>
  
  <link rel="stylesheet" href="style/reset.css">

  <link rel='stylesheet prefetch' href='style/font.css'>

  <link rel="stylesheet" href="style/style.css">

  
</head>
<script>
<?php if($_GET['result']=="fail"){?>
	window.alert("Wrong Username/Password combination");
<?php }
?>
<?php if($_GET['result']=="sendmail"){?>
	window.alert("Your Password has been sent to your Email");
<?php }
?>
</script>
<body>

<div class="pen-title">
  <h1>Open Elective Recommendation System</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle">
  
  </div>
  <div class="form">
    <h2>Admin Account</h2>
    <form action="checklogin" method="post">
      <input type="text" placeholder="Username" name="rollno" required/>
      <input type="password" placeholder="Password" name="password" required/>
	  <input type="hidden" name="loginmode" value="admin"/>
      <button>Login</button>
    </form>
  </div>
  
  <!--<div class="cta"><a href="http://localhost/MiniProject/emailrem">Forgot your password?</a></div> -->
</div>
<div>

</div>
<script src='JS/jquery.js'></script>


    <script src="js/index.js"></script>

</body>
</html>