<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Formular de autentificare</title>
<link rel="stylesheet" href="style.css" />
<style>
h1 {
	font-family:arial;
    color: white;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

h3 {
	font-family:arial;
    color: white;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

div {
	background-color: #555652;
	height: 500px;
}


</style>
</head>

<body style="background-image:url(wall.jpg)"> 
<?php
require('usersdb.php');
session_start();
if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
	    header("Location: index.php");
         }else{ 
	echo "<div class='form'>
<h1> <br><br><br><br><br>Nume utilizator sau parola introduse gresit!</h1>
<br/><h3>Reveniti la pagina de autentificare: <a href='logare.php'>Login</h3></a></div>";
	}
    }else{ 
?><br><br><br><br><br><br><br><br>
	<form class="login" action="" method="post" name="login">
    <input type="text" class="login-input" name="username" placeholder="Username" autofocus required>
    <input type="password" class="login-input" name="password" placeholder="Parola" required>
  <center> <input type="submit" value="Login" name="submit" class="login-button"> </center>
  <p class="login-lost">Creează cont nou <a href="inregistrare.php">Înregistrare</a></p>
  </form>

<?php } ?>
</body>
</html>