<?php
include("redirectare.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Succes!</title>
<link rel="stylesheet" href="style.css" />
<style>
h1 {
	font-family:arial;
    color: white;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

h2 {
	font-family:arial;
    color: white;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

h3 {
	font-family:arial;
    color: white;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
</style>
</head>
<body>
<div class="form"><br><br><br><br><br><br><br><br><br><br>
<h2>Autentificarea s-a realizat cu succes!</h2>
<h1>Bun venit <?php echo $_SESSION['username']; ?> !</h1>
<p><h3><a href="interfata.php">Accesare interfață</h3></a></p>
<h3><a href="delogare.php">Logout</h3></a>
</div>
</body>
</html>   