<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Formular de inregistrare</title>
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
<body>
<body style="background-image:url(wall2.jpg)"> 
<?php
require('usersdb.php');
if (isset($_REQUEST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<br><div class='form'>
<h1> <br><br><br><br><br>înregistrare efectuată !</h1>
<br/><h3>Pagina de autentificare: <a href='logare.php'>Aici</h3></a></div>";
        }
    }else{
?>   <br><br><br><br><br><br>
	<form class="login" action="" method="post">
   
		<input type="text" class="login-input" name="username" placeholder="Username" required autofocus />
    <input type="text" class="login-input" name="email" placeholder="Email " required>
    <input type="password" class="login-input" name="password" placeholder="Parola" required>
 <center>   <input type="submit" name="submit" value="Înregistrare" class="login-button"> </center>
  <p class="login-lost">Aveți deja cont? <a href="logare.php">Autentificare</a></p>
  </form>

<?php } ?>
</body>
</html>