<?php
	
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'proiect';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	$data1 = '';
	$data2 = '';

	$sql = "SELECT * FROM `datesenzor` ";
    $result = mysqli_query($mysqli, $sql);

	while ($row = mysqli_fetch_array($result)) {

		$data1 = $data1 . '"'. $row['temperatura'].'",';
		$data2 = $data2 . '"'. $row['temperatura'] .'",';
		
	}   

	$data1 = trim($data1,",");
	$data2 = trim($data2,",");
?>

<?php
require('db.php');
include("redirectare.php");
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<title>Interfata</title>
<link rel="stylesheet" href="style.css" /> 

<style type="text/css">
body {
	background-color: #f6f6ff;
	font-family: Calibri, Myriad;
}


#main {
	width: 780px;
	padding: 20px;
	margin: auto;
}

table.timecard {
	margin: auto;
	width: 500px;
	border-collapse: collapse;
	border: 1px solid #fff; /*for older IE*/
	border-style: hidden;
}

table.timecard caption {
	background-color: #f79646;
	color: #fff;
	font-size: x-large;
	font-weight: bold;
	letter-spacing: .3em;
}

table.timecard thead th {
	padding: 8px;
	background-color: #fde9d9;
	font-size: large;
}

table.timecard thead th#thDay {
	width: 40%;	
}

table.timecard thead th#thRegular, table.timecard thead th#thOvertime, table.timecard thead th#thTotal {
	width: 20%;
}

table.timecard th, table.timecard td {
	padding: 3px;
	border-width: 1px;
	border-style: solid;
	border-color: #f79646 #ccc;
}

table.timecard td {
	text-align: right;
}

table.timecard tbody th {
	text-align: left;
	font-weight: normal;
}

table.timecard tfoot {
	font-weight: bold;
	font-size: large;
	background-color: #687886;
	color: #fff;
}

table.timecard tr.even {
	background-color: #fde9d9;
}
</style>

<style>

input[type=button], input[type=submit], input[type=reset] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  position:absolute;
    transition: .5s ease;
    top: 34%;
    left: 78%;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
 float: right;
  display: block;
}
</style>
<style type="text/css">			
			body{
				font-family: Arial;
			    margin: 80px 100px 10px 100px;
			    padding: 0;
			    color: white;
			    text-align: center;
			    background: #555652;
			}
			

			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
			}
		</style>
<style type="text/css">			
			body{
				font-family: Arial;
			    margin: 80px 100px 10px 100px;
			    padding: 0;
			    color: white;
			    text-align: center;
			    background: #555652;
			}

			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
			}
		</style>	
<style>
canvas{

  width:580px !important;
  height:400px !important;

}
</style>

<style>
#content-wrapper{
	position: absolute;
	top: 116px;
	left: 500px;
	width: 80%;
	height: 514px;
	margin: 0px auto;
}
#lhs{
	position: relative;
	float: left;
	height: 514px;
	width: 51%;
	text-align: center;
}

#content-wrapper2{
	position: absolute;
	top: 438px;
	left: 155px;
	width: 80%;
	height: 514px;
	margin: 0px auto;
    z-index: 1;

</style>
<style>
.button {
    position:absolute;
    transition: .5s ease;
    top: 50%;
    left: 50%;
}
</style>

</head>
<body>
<pre class="tab">
<div class="form">
<p ><h2><a href="test.php">Rulare exe</a>	<a href="inregistrare.php">Cont nou</a>	<a href="interfata.php">Revenire</a>	<a href="delogare.php">Logout</a>			Utilizator autentificat: <?php echo $_SESSION['username']; ?> </h2></a></p>

</pre>

<br><br>
<h2>Aplicatie informatica de monitorizare a consumului de energie termica</h2>
<br><br>

<p>Aceasta aplicatia are intentia de a oferi indicatii generale cu privire la consumul de energie termica de la nivelul unei incinte.Acest lucru a fost posibil datorita exemplului de calcul pus la dispozitie de catre compania TiSoft, companie ce se ocupa cu dezvoltarea de software pentru inginerii responsabili cu designul,operarea si monitorizarea serviciilor tehnice pentru cladiri.<br>
<center> <a href="https://www.ti-soft.com/" target="_blank">https://www.ti-soft.com/</a></center> 
<br><br>
Interfata este una simpla si intuitiva.Aplicatia lucreaza cu valori ale temperaturii ce sunt preluate din baza de date MySQL, utilizatorul putand introduce numarul de ore in care functioneaza radiatorul intr-o zi.Astfel,in functie de acesti doi factori se poate intui ca pentru a avea o temperatura ridicata in incita,pentru un numar cat mai mare de ore,este de asemenea nevoie de un consum termic cat mai ridicat.<br><br>

S-a optat pentru folosirea unui sistem expert a carui baza de cunostinte cuprinde fapte si reguli din domeniul de expertiza considerat.Motorul de inferenta are la baza crearea unui lant de rationamente deductiv in vederea rezolvarii problemelor din acest domeniu ales.Prin urmare,la introducerea numarului de ore, de catre utilizator si prin intermediul regulilor de tiplul IF... THEN,se realizeaza o predicite minimala cu privire la consum.<br><br>

Aplicatia dispune de un sistem de inregistrare si autentificare, prin intermediul carora se asigura securitatea accesului la interfata aplicatiei.<br><br>

O ultima referire se face asupra unui fisier executabil ce a fost scris in limbajul C++ si care incearca o abordare diferita a aplicatiei.In acest sens,valoarea concreta a temperaturii este inlocuita de un termen lingvistic.Se opteaza astfel pentru utilizarea unui set fuzzy, neclar.In continuare,pe baza acestor termeni lingvistici se construiesc reguli de productie ca si in cazul precedent.</p>

<br><br>
<center><img src="untitled.jpg"></center>

<div class="split left">
  <div class="centered">
<div style="padding-left:16px">

</body>
</html>